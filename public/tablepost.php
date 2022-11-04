<?php

session_start();

require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$pdo = Connexion::getPDO();

/**
 * ****************************************************************La pagination*******************************
 */







$current_page = getInt('page',1);

if ($current_page <=0)
{
    header('location: errors.php');
    die();
    // throw new Exception("le numero de page invalide");
}
$count = (int)$pdo->query("SELECT COUNT(id_post) FROM post")->fetch(PDO::FETCH_NUM)[0];

$perPage = 12;

$pages = ceil($count / $perPage);

if ($current_page > $pages)
{
    header('location: errors.php');
    die();
    // throw new Exception("le numero de page invalide");
}

$offset = $perPage * ($current_page-1); 






// **************************************************************************************************************

$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS,Post::class);



$succes = false;

    echo "<div class='alert alert-success'>Vous êtes connecté avec succès à la page d'administration!</div>";

?>

<div class="container mt-200">

    <?php if($succes):?>

    <div class="alert alert-success">l'article a été supprimé avec succes!</div>

    <?php endif ?>

</div>

<table class="table table-striped">
<h1>La liste des articles</h1>
    <thead>
        <th>#ID</th>
        <th>Nom</th>
        <th><a href="createpost.php" class="btn btn-primary">Nouvel article</a ></th>
    </thead>
    <?php foreach($posts as $post): ?>
    <tbody>
        <tr>
            <td>#<?=$post->getID()?></td>
            <td><?=$post->getName()?></td>
            <td><a href="postedit.php?post_id=<?=$post->getID()?>" class="btn btn-primary">Editer</a >&nbsp;&nbsp;
            <a href="?de=<?=$post->getID()?>" class="btn btn-danger" onclick="alert('voulez-vous confirmer vraiment cette action?');">Supprimer</a></td>
        </tr>
    </tbody>
            <?php if(isset($_GET['de']) && $_GET['de']==$post->getID())
            {
                $id = $post->getID();

                $pdo->exec("DELETE FROM post WHERE id_post = {$id}");

                $_GET['de'] = 0;

                $succes = true;

                header("location:tablepost.php");

                die();

            }
        ?>
    <?php endforeach ?>
</table>







 <!--****************************************************************la pagination*********************************************************-->
<div class="d-flex justify-content-between my-4">

    <?php if($current_page >1 && $current_page <= $pages): ?>
        <a href="?page=<?=$current_page -1 ?>" class="btn btn-primary">&laquo; Page précédente</a>
    <?php endif ?>
    <?php if($current_page >= 1 && $current_page < $pages): ?>
        <a href="?page=<?=$current_page +1 ?>" class="btn btn-primary ml-0">Page suivante &raquo;</a>
    <?php endif ?>
    
</div>



 <!--****************************************************************la pagination*********************************************************-->


<?php require "footer.php" ?>
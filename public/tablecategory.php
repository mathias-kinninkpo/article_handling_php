<?php

session_start();

require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$pdo = Connexion::getPDO();

$query = $pdo->query("SELECT * FROM category");

$categories = $query->fetchAll(PDO::FETCH_CLASS,Category::class);


$succes = false;

if(isset($_SESSION['user'])){
    echo "<div class='alert alert-success'>Vous êtes connecté avec succès à la page d'administration!</div>";
}
?>

<div class="container mt-200">

    <?php if($succes):?>

    <div class="alert alert-success">l'article a été supprimé avec succes!</div>

    <?php endif ?>

</div>


<table class="table table-striped">
<h1>La liste des Categories</h1>
    <thead>
        <th>#ID</th>
        <th>Nom</th>
        <th><a href="createcategory.php" class="btn btn-primary">Nouvelle categorie</a ></th>
    </thead>
    <?php foreach($categories as $category): ?>
    <tbody>
        <tr>
            <td>#<?=$category->getId()?></td>
            <td><?=$category->getName()?></td>
            <td><a href="edit_cat.php?id=<?=$category->getId() ?>" class="btn btn-primary">Editer</a >&nbsp;&nbsp;
            <a href="?de=<?=$category->getId()?>" class="btn btn-danger" onclick="alert('voulez-vous confirmer vraiment cette action?');">Supprimer</a></td>
        </tr>
    </tbody>
                <?php if(isset($_GET['de']) && $_GET['de'] == $category->getId())
                {
                    $idc = $_GET['de'];

                    $pdo->exec("DELETE FROM category WHERE category_id = {$idc}");

                    $_GET['de'] = 0;

                    $succes = true;
                    
                    header("location:tablecategory.php");
                }

                ?>

    <?php endforeach ?>
</table>




<!-- **********************************************************************delete********************************************************** -->




<?php require "footer.php" ?>
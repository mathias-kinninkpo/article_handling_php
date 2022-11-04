<?php 
$title = 'Mon blog';

require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$pdo = Connexion::getPDO();

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


$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS,Post::class);


?>

<h1>Mon blog</h1>

<div class="row">
<?php foreach($posts as $post): ?>
    <div class="col-md-3">
       <?php require 'card.php'?>
    </div>
<?php endforeach ?> 
</div>


<div class="d-flex justify-content-between my-4">

    <?php if($current_page >1 && $current_page <= $pages): ?>
        <a href="?page=<?=$current_page -1 ?>" class="btn btn-primary">&laquo; Page précédente</a>
    <?php endif ?>
    <?php if($current_page >= 1 && $current_page < $pages): ?>
        <a href="?page=<?=$current_page +1 ?>" class="btn btn-primary ml-0">Page suivante &raquo;</a>
    <?php endif ?>
    
</div>

<!-- <div class="container">
        <a href="admin.php" class="btn btn-primary">Administrer</a>

</div> -->



<?php require "footer.php" ?>
<?php require "header.php";

require '../class/class.php';

require '../class/connexion.php';

// require 'post_categories.php';

$id = getInt('cat_id',0);


$pdo = Connexion::getPDO();


$current_page = getInt('page',1);



$count = (int)$pdo->query("SELECT COUNT(post.id_post) as count FROM post
                      INNER JOIN post_category ON post_category.post_id=post.id_post
                      WHERE category_id = $id")->fetch()['count'];



$perPage = 12;

$offset = $perPage * ($current_page-1);

$pages = ceil($count / $perPage);


if ($current_page > $pages)
{
    /*header('location: errors.php');
    die();*/
    throw new Exception("le numero de page invalide");
}



$query = $pdo->prepare("SELECT post.* FROM post
                        INNER JOIN post_category ON post_category.post_id=post.id_post
                        WHERE category_id = ?
                        LIMIT  $perPage OFFSET $offset");




$query->execute([$id]) ;

$query->setFetchMode(PDO::FETCH_CLASS,Post::class);

$posts_category = $query->fetchAll();



?>

<div class="row">
<h1>La categorie <span style="font-size:35px;color:green"><?=$pdo->query("select name from category where category_id=$id")->fetch()['name']?></span></h1>
<?php foreach($posts_category as $post): ?>
    <div class="col-md-3 mt-5">
    <div class="card mb-3">
           <div class="card-body">
                <h4 class="card-title"> <?=htmlentities($post->getName())?> </h4>
                <p><?=$post->getExcerpt()?></p>
                <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y H:i')?></p>
                <p>
                    <a href="post.php?slug=<?=htmlentities($post->getSlug())?>&id=<?=htmlentities($post->getID())?>" class="btn btn-primary">Voir plus</a>
                </p>
           </div>
</div>
    </div>
<?php endforeach ?> 
</div>


<div class="d-flex justify-content-between my-4">


    <?php if($current_page >1 && $current_page <= $pages): ?>
        <a href="?page=<?=$current_page -1 ?>&cat_id=<?=$id?>" class="btn btn-primary">&laquo; Page précédente</a>
    <?php endif ?>
    <?php if($current_page >= 1 && $current_page < $pages): ?>
        <a href="?page=<?=$current_page +1 ?>&cat_id=<?=$id?>" class="btn btn-primary ml-0">Page suivante &raquo;</a>
    <?php endif ?>
    
</div>
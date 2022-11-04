<?php

session_start();
require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$pdo = Connexion::getPDO();

$id = $_GET['post_id'] ?? 0;


$post = $pdo->query("select * from post where id_post=  $id")->fetchAll(PDO::FETCH_CLASS,Post::class)[0];



?>



<h1>Modifier l'article</h1>
    <form action="edit.php?id=<?=$_GET['post_id']?>" method="post">
    <label for="name" style="font-size:30px">Nom de l'artile</label>
        <div class="form-group">
        
            <input style="height: 50px;" type="text" class="form-control" name = "name" id="name" value="<?=e($post->getName())?>">  
        </div><br>
        <div class="form-group">
        <label for="slug" style="font-size:30px">Le slug de l'article</label>
            <input style="height: 50px;" type="text" class="form-control" name = "slug" id="slug" value="<?=e($post->getSlug())?>">  
        </div><br> 
        <label for="content" style="font-size:30px">Le contenu de l'article</label>
        <div class="form-group">
            <textarea name="content" id="content" cols="140" rows="3" class="form-control"><?=e($post->getContent())?></textarea>
        </div><br> 
        <button class="btn btn-primary">Modifier</button>
    </form>



<?php require 'footer.php'?>
<?php

session_start();

require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$pdo = Connexion::getPDO();

$id = $_GET['id'] ?? 0;


$category = $pdo->query("select * from category where category_id =  $id")->fetchAll(PDO::FETCH_CLASS,Category::class)[0];


?>



<h1>Modifier la category</h1>
    <form action="cateEdit.php?id=<?=$id?>" method="post">
    <label for="name" style="font-size:30px">Nom de la category</label>
        <div class="form-group">
        
            <input style="height: 50px;" type="text" class="form-control" name = "name" id="name" value="<?= $category ? e($category->getName()) :""?>">  
        </div><br>
        <div class="form-group">
        <label for="slug" style="font-size:30px">Le slug de la category</label>
            <input style="height: 50px;" type="text" class="form-control" name = "slug" id="slug" value="<?= $category ? e($category->getSlug()) : ""?>">  
        </div><br> 

        <button class="btn btn-primary">Modifier</button>
    </form>



<?php require 'footer.php'?>
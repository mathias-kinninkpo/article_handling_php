<?php

session_start();
require "header.php" ;


?>

<h1>Creer un article </h1>
    <form action="create.php" method="post">
    <label for="name" style="font-size:30px">Nom de l'artile</label>
        <div class="form-group">
        
            <input style="height: 50px;" type="text" class="form-control" name = "name" id="name"placeholder='03 caracteres au minimum'>  
        </div><br>
        <div class="form-group">
        <label for="slug" style="font-size:30px">Le slug de l'article</label>
            <input style="height: 50px;" type="text" class="form-control" name = "slug" id="slug" placeholder='07 caracteres au minimum'>  
        </div><br> 
        <label for="content" style="font-size:30px">Le contenu de l'article</label>
        <div class="form-group">
            <textarea name="content" id="content" cols="140" rows="3" class="form-control"></textarea>
        </div><br> 
        <button class="btn btn-primary">Creer</button>
    </form>

<?php require 'footer.php'?>
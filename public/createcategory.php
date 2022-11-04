<?php

session_start();
require "header.php" ;


?>

<h1>Creer une category </h1>
    <form action="cateCreate.php" method="post">
    <label for="name" style="font-size:30px">Nom de la category</label>
        <div class="form-group">
        
            <input style="height: 50px;" type="text" class="form-control" name = "name" id="name"placeholder='03 caracteres au minimum'>  
        </div><br>
        <div class="form-group">
        <label for="slug" style="font-size:30px">Le slug de la category</label>
            <input style="height: 50px;" type="text" class="form-control" name = "slug" id="slug" placeholder='07 caracteres au minimum'>  
        </div><br> 
        <button class="btn btn-primary">Creer</button>
    </form>

<?php require 'footer.php'?>
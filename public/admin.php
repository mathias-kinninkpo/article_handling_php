<?php
require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$pdo = Connexion::getPDO();

$query = $pdo->query("SELECT password FROM user");

$pass = $query->fetch(PDO::FETCH_NUM)[0];

if(!isset($_SESSION['user'])){
    echo "<div class='alert alert-danger'>Accès interdit!!! <br> La page est reservée aux administrateurs <br> Connectez-vous en tant qu'administrateur!</div>";
}

?>



<h1>Se connecter </h1>
    <form action="" method="post">
    <label for="name" style="font-size:30px">Username</label>
        <div class="form-group">
        
            <input style="height: 50px;" type="text" class="form-control" name = "name" id="name"placeholder='03 caracteres au minimum' required>  
        </div><br>
        <div class="form-group">
        <label for="pass" style="font-size:30px">Mot de passe</label>
            <input style="height: 50px;" type="password" class="form-control" name = "pass" id="pass" placeholder='07 caracteres au minimum' required>  
        </div><br> 
        <button class="btn btn-primary">Se connecter</button><br><br>
    </form>

    <?php if(isset($_POST['name']) && isset($_POST['pass'])){


        if(password_verify($_POST['pass'],$pass) && $_POST['name']== "admin"){

            session_start();

            $_SESSION['user'] = 'admin';

            header("location:tablepost.php");
        }
        else
        {
            echo "<div class='alert alert-danger'>le username ou le mot de passe est incorrect!</div>";
            
        }
    }
    
 ?>

    
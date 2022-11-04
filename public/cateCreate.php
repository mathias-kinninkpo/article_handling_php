<?php
require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$category = new CreateUpdate("category");

$succes = false;

if($category->isValidCategory($_POST['name'], $_POST['slug']))
{
    $category->insertCetegory($_POST['name'], $_POST['slug']);

    $succes = true;
}
?>
<div class="container mt-200">

    <?php if($succes):?>

    <div class="alert alert-success">La category <?=$_POST['name'] ?> a été créée avec succès!</div>

    <?php else :?>

    <div class="alert alert-danger ">Le nom ou le slug est trop court!</div>


    <?php endif ?>


    <br>
    <br>
    <a href="tablepost.php" class="btn btn-primary">la liste des article</a>


</div>






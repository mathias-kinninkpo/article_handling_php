<?php
session_start();

require "header.php" ;
require "../class/class.php";
require "../class/connexion.php";

$post = new CreateUpdate("post");

$succes = false;

if($post->isValidPost($_POST['name'], $_POST['slug'],$_POST['content']))
{
    $post->insertPost($_POST['name'], $_POST['slug'],$_POST['content']);

    $succes = true;
}
?>
<div class="container mt-200">

    <?php if($succes):?>

    <div class="alert alert-success">L'article <?=$_POST['name'] ?> a été créé avec succès!</div>

    <?php else :?>

    <div class="alert alert-danger ">Le nom ou le slug est trop court!</div>


    <?php endif ?>


    <br>
    <br>
    <a href="tablepost.php" class="btn btn-primary">la liste des article</a>


</div>






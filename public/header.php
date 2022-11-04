<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Mon site" ?></title>
    <link rel="stylesheet" href="bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> 


    <style>
    nav a:hover{
        /* width:100%; */
        padding:5px ;
        height:100%;
        border-radius:7px;
        background-color:#050;
        position:relative;
        transition: .5s;

    }
    nav a:active{
        /* width:100%; */
        padding:5px ;
        height:100%;
        border-radius:7px;
        background-color:#050;
        position:relative;
        /* transition: .5s; */

    table a:hover{
        transition: .2s;
        border : 1px solid #000;
        /* box-shadow : 0px 0px 5px #555; */
        padding:7px 12px


    }
    
    </style>
</head>
<body class="d-flex flex-column h-100">
<!-- <?php define("TIME_DEBUG",microtime(true)) ?> -->
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style='text-align:center;'>
        <a href="blog.php" class='navbar-brand'><?=isset($_SESSION['user']) ? 'Se deconnecter' : 'Mon Blog' ?></a>
        <a href="<?=isset($_SESSION['user']) ? 'tablepost.php' : '#'?>" class='navbar-brand'><?=isset($_SESSION['user']) ? 'Articles' : ''?></a>
        <a href="<?=isset($_SESSION['user']) ? 'tablecategory.php' : '#'?>" class='navbar-brand'><?=isset($_SESSION['user']) ? 'Categories' : ''?></a>
        <a href="admin.php" class='navbar-brand'><?=isset($_SESSION['user']) ? '' : 'Administrer'?></a>

    </nav>

    <div class="container">
    
    
<?php

// require 'header.php';

// require dirname(__DIR__) .'/class/class.php';

// require dirname(__DIR__) .'/class/login.php';

$pdo1 = Connexion::getPDO();

$query_1 = $pdo1->prepare("SELECT c.category_id, c.name, c.slug
                           FROM category c 
                           INNER JOIN post_category pc ON c.category_id=pc.category_id 
                           WHERE post_id=:id");

$query_1->execute(['id' => getInt('id',1)]) ;

$query_1->setFetchMode(PDO::FETCH_CLASS,Category::class);

$categories_post = $query_1->fetchAll();

// var_dump($post_categories);
# article_handling_php
Le projet ci est un site web de gestion des article dans un magasin d'article

le site a été codé avec html, css, php et les commande avec sql

Le systeme de gestion de la base de donnée est mysql



Concernant l'architecture des dossiers, nous avons un dossier classe dans lequel se trouve un fichier connexion.php qui effectue la connexion à la base de donnée



<?php

class Connexion{
    public static function getPDO() :PDO

    {
        $server = '127.0.0.1';
        $pass = '';
            
        $login = 'root';

       return new PDO("mysql:host=$server;dbname=article", $login, $pass, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
}

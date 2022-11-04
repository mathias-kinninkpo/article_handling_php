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
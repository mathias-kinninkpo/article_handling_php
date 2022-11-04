<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

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

$pdo = Connexion::getPDO();

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE TABLE post");
$pdo->exec("TRUNCATE TABLE user");
$pdo->exec("TRUNCATE TABLE category");
$pdo->exec("TRUNCATE TABLE post_category");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

$posts = [];
$categories = [];


for($i=0; $i < 80; $i++){
    $pdo->exec("INSERT INTO post SET name='{$faker->sentence(5) }', slug='{$faker->slug}', created_at='{$faker->date} {$faker->time}', content='{$faker->paragraphs(rand(3,15), true)}'"); 
    $posts[] = $pdo->lastInsertId();
}
for($i=0; $i < 10; $i++){
    $pdo->exec("INSERT INTO category SET name='{$faker->sentence(3) }', slug='{$faker->slug}'"); 
    $categories[] = $pdo->lastInsertId();
}

foreach($posts as $post) {
    $random_cat =  $faker->randomElements($categories, rand(0, count($categories)));
        foreach ($random_cat as $cat) {
            $pdo->exec("INSERT INTO post_category SET post_id = $post , category_id = $cat"); 

        }
}

$password = password_hash('admin',PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username = 'admin' , password =  '$password'");



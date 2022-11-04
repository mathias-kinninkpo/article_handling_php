<?php require "header.php";

require '../class/class.php';

require '../class/connexion.php';

require 'categoriesPost.php';

$pdo = Connexion::getPDO();

$query = $pdo->prepare("SELECT * FROM category WHERE category_id = :id");

$id = getInt('cat_id',0);

$query->execute(['id' => $id]) ;

$query->setFetchMode(PDO::FETCH_CLASS,Category::class);

$cat = $query->fetch();

?>

<h1>Ma categorie</h1>

<div class="container">
            <?php if($id >0 || $id <= 10): ?>
                <div class="card-body">
                    <h4 class="card-title"> <?php if($cat):?>
                    <?=$cat->getName()?>
                    <?php else: header('location:errors.php');
                    
                    endif?> </h4>
                    <br>
                    <p><?=$cat->getSlug()?></p>

           
                </div>
            <?php endif ?>
            </div>

<?php require "footer.php" ?>
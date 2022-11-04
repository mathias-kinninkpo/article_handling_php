<?php

require 'header.php';

require '../class/class.php';

require '../class/connexion.php';

require 'categoriesPost.php';

$pdo = Connexion::getPDO();

$query = $pdo->prepare("SELECT * FROM post WHERE id_post = :id");

$id = getInt('id',0);

$query->execute(['id' => $id]) ;

$query->setFetchMode(PDO::FETCH_CLASS,Post::class);

$post = $query->fetch();


?>

            <div class="container">
                <div class="card-body">
                    <h1 class="card-title"> <?php if($post):?>L'article 
                   <span style="color:#090"> <?=$post->getName()?></span>
                    <?php else: header('location:errors.php');
                    
                    endif?> </h1>
                    <br>
                    <ol>
                    <?php foreach($categories_post as $category_post):?>
                        <li><a href="postsCategory.php?cat_id=<?=$category_post->getId()?>" style = "text-decoration:none; font-size:20px"><?=htmlentities($category_post->getName())?></a></li>
                    <?php endforeach ?>
                    </ol>
                    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y H:i')?></p>
                    <p><?=$post->getContent()?></p>

           
                </div>

            </div>

 

<h1></h1>





<?php require 'footer.php'?>
<div class="card mb-3">
           <div class="card-body">
                <h4 class="card-title"> <?=htmlentities($post->getName())?> </h4>
                <p><?=$post->getExcerpt()?></p>
                <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y H:i')?></p>
                <p>
                    <a href="post.php?slug=<?=htmlentities($post->getSlug())?>&id=<?=htmlentities($post->getID())?>" class="btn btn-primary">Voir plus</a>
                </p>
           </div>
</div>
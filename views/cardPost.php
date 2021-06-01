<?php 
$categories = [];
$categoryID = [];
    foreach($post->getCategories() as $category) {
                $url = $router->url('categorie', ['slug' => $category->getSlug(), 'id' => $category->getId()]);
                
                $categoryID[] = $category->getId();
                
                if(count($categoryID) > 1) {
                    $wordCatgory ="Catégories : ";
                    }     
                else{  
                    $wordCatgory ="Catégorie :";
                    } 

                $categories[] = <<<HTML
                <a class="link" href="{$url}">{$category->getName()}</a>
HTML;                    
                }             
?>

        <div class="row">
            <div class="col-12">
                <?php if($post->getImage()): ?>
                    <a class="btn button" href="<?= $router->url('post_show',['id'=> $post->getID(),
                                                'slug' => $post->getSlug()]); ?>">
                    <img  src="<?=$post->getImageURL('cardArticle'); ?>" class="img-fluid"> 
                    </a>
                <?php endif ?>
                <h5 class=""><?=htmlentities($post->getName_video());?></h5>
            </div>
            <div class="col-12">
                
            </div>
            <div class="col-12">
                <span>Youtube :</span>
                <a class="link" href="<?= $post->getPath_youtube()?>" target="_blank">
                    <?= $post->getName_author()?>
                </a>
            </div>
            <div class="col-12">
                <?php if(!empty($post->getCategories())): ?>
                        <p><?=$wordCatgory. implode(", ", $categories); ?></p>
                <?php endif; ?>
                <p class="text-muted"> Créer le :  <?=$post->getCreated_at()->format('d/m/Y'); ?></p>
                <p><?= $post->getExcerpt();?>
                    <a class="link" href="<?= $router->url('post_show',['id'=> $post->getID(),
                                          'slug' => $post->getSlug()]); ?>"> 
                        Voir plus 
                    </a>
                </p>
                
            </div>
        </div>



        
        
        
        
        
        
        
            




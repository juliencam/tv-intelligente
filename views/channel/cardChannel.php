<?php 
$categories = [];
$categoryID = [];

    foreach($channel->getCategories() as $category) {
                $url = $router->url('categorie', ['slug' => $category->getSlug(), 'id' => $category->getId()]);
                
                $categoryID[] = $category->getId();
                
                if(count($categoryID) > 1) {
                    $wordCatgory ="Catégories : ";
                    }     
                else{  
                    $wordCatgory ="Catégorie :";
                    } 

                $categories[] = <<<HTML
                <a href="{$url}">{$category->getName()}</a>
HTML;                    
                }             
?>


<div class = "p-3 rounded">

    <div class="card text-center bg-card-color">
        <div class="card-body">
            <?php if($channel->getImage()): ?>
                <img  src="<?=$channel->getImageURL('cardChannel'); ?>" class="img-fluid">
            <?php endif ?>      
        </div>
        <?php if(!empty($channel->getCategories())): ?>
                <p><?=$wordCatgory. implode(", ", $categories); ?></p>
        <?php endif; ?>               
            <h3 class="card-title"> <a href="<?= $channel->getPath_youtube()?>" target="_blank" ><?=htmlentities($channel->getName_author());?></a></h3>
            <p class="text-muted"> Ajouter le :  <?=$channel->getCreated_at()->format('d/m/Y'); ?></p>
            <div class="card-body">
                <a href="<?= $channel->getPath_youtube()?>" class="btn btn-danger btn-lg" target="_blank" role="button" >Chaîne Youtube</a>
            </div>
    </div>

</div>

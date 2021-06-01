<?php
use App\Connection;

use App\Table\PostTable;
use App\Table\CategoryTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$title = 'Article';

$pdo = Connection::getPDO();

$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);

$description = "Une vidéo brillante du youtubeur {$post->getName_author()} . 
                Découvrez du contenu aussi intéressant que brillant sur d'autres sujets ";

if ($slug !== $post->getSlug()){
    $url = $router->url('post_show',['slug' => $post->getSlug(), 'id' =>$id ]);
    http_response_code(301);
    header('Location: '. $url);
    exit();
}
$wordCategory = "<span>Catégorie : </span>";
foreach($post->getCategories() as $k => $category){
    if($k > 0 ){
        $wordCategory = "<span>Catégories : </span>";
    }  
} 
?>
    <div class="container py-5 my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <?=html_entity_decode($post->getI_frame())?>
            </div>

            <div class="col-md-6">
                <h1><?= htmlentities($post->getName_author())?> : <?=htmlentities($post->getName_video());?></h1>
                <p class="text-muted"> Créer le :  <?=$post->getCreated_at()->format('d/m/Y'); ?></p>
                <p><?= $post->getContent();?></p>
                <?=$wordCategory; ?>
                <?php foreach($post->getCategories() as $k => $category):?>

                    <?php if($k > 0 ): ?>
                            ,
                    <?php endif; ?>  
                        
                    <a class="link" href="<?=$router->url('categorie', ['slug'=> $category->getSlug(), 
                        'id'=> $category->getId()]) ?>"> 
                        <?= htmlentities($category->getName()) ; ?> 
                    </a>

                <?php endforeach;?> 
            </div>

            <div class="col-12 d-flex flex-column justify-content-center align-items-center my-5">
                <h2 class=""><?= htmlentities($post->getName_author())?></h2>
                <a href="<?= $post->getPath_youtube()?>" class="btn btn-danger btn-lg" 
                target="_blank" role="button" >Chaîne Youtube</a>
            </div>
        </div>
    </div>

   

        

       

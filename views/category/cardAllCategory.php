<?php 

$url = $router->url('categorie', ['slug' => $category->getSlug(), 'id' => $category->getId()]);
                          
?>
    <div class="col-12 col-md-2 d-flex justify-content-center py-5">
    <a class="btn button button-category" href="<?= $url ?>">
        <?= $category->getName() ?>
    </a>
    </div>
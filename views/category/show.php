<?php 
use App\Connection;
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();

$category = (new CategoryTable($pdo))->find($id);

if ($slug !== $category->getSlug()){
    $url = $router->url('categorie',['slug' => $category->getSlug(), 'id' =>$id ]);
    http_response_code(301);
    header('Location: '. $url);
    exit();
}

$title = "Catégorie : {$category->getName()}";
$description = "Un sujet très intéressant parmi tant d'autres.
                Découvrez toutes les vidéos de la catégorie {$category->getName()}";

[$posts, $pagination] =(new PostTable($pdo))->findPaginatedCategory($category->getId());

$link =  $router->url('categorie', ['slug' => $category->getSlug(), 'id' => $category->getId()]);

?>

<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
        <h1 class="text-center"><?= htmlentities($title);?></h1>
        </div>
    </div>
</div>

<div class="container-fluid my-5">

     <div class="row justify-content-between">
         <div class="col-6">
            <?= $pagination->previousLink($link); ?>
         </div>
         <div class="col-6 d-flex justify-content-end">
            <?= $pagination->nextLink($link); ?>
         </div>
     </div>

</div>


<div class="container-fluid"> 
    <div class="row justify-content-center">
        <?php foreach($posts as $post): ?> 
            <div class="col-xl-3 mt-4 px-4 py-4 mx-4 border-article">
            <?php require '../views/cardPost.php'; ?>
            </div>
            
        <?php endforeach; ?>
    </div>
</div>


<div class="container-fluid my-5">

     <div class="row justify-content-between">
         <div class="col-6">
            <?= $pagination->previousLink($link); ?>
         </div>
         <div class="col-6 d-flex justify-content-end">
            <?= $pagination->nextLink($link); ?>
         </div>
     </div>

</div>
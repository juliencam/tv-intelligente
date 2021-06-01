<?php 
use App\Connection;
use App\Table\CategoryTable;

$title = 'Catégories'; 
$description = 'Tous les vidéos sont référencés par catégories.
                Découvrez les sujets qui vont remplacer vos soirées télé';
$pdo = Connection::getPDO();

$categoryTable = new CategoryTable($pdo);
[$categories, $pagination] = $categoryTable->findPaginatedAllCategories();

$link = $router->url('categories');

?>
<div class="container my-5">
  <div class="row justify-content-center">
  
     
        <?php foreach($categories as $category): ?> 
            
            <?php require '../views/category/cardAllCategory.php'; ?>
            
        <?php endforeach; ?>
     

  </div>
</div>


<div class="d-flex justify-content-between my-4">
     <?= $pagination->previousLink($link); ?>
     <?= $pagination->nextLink($link); ?>
</div>






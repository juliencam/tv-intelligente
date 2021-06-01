<?php 
 
use App\Connection;

use App\Table\PostTable;

use App\Model\VideoHeader;

$title = 'Accueil';

$description = 'Une TV distrayante qui rend intelligent, c\'est possible.

Ce site référence du contenu youtube';

$pdo = Connection::getPDO();



$table = new PostTable($pdo);



[$posts, $pagination] = $table->findPaginated();



$query = $pdo->query(" SELECT * FROM video_header WHERE id");

        $query->setFetchMode(PDO::FETCH_CLASS, VideoHeader::class);

        $videoHeader=$query->fetch();

        if ($videoHeader === false){

            throw new Exception('Données non trouvées');

        }



$link = $router->url('home');



?>

<?php if ($pagination->getPageForHeaderVideo() === 1): ?>

    <?php require '../views/post/cardHeaderHome.php'; ?>

<?php endif; ?>

<div class="header-separation" style="height: 300px;">

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

<div class="container-fluid "> 
    <div class = "row justify-content-center">
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






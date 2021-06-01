<?php
use App\Connection;
use App\Model\Post;
use App\Table\PostTable;

$title = 'Chaînes Youtubes';

$pdo = Connection::getPDO();

[$channels, $pagination] = (new PostTable($pdo))->findPaginatedChannels();
$link = $router->url('channels');

$description = 'Tous les youtubeurs intelligents du site 
                sont répertoriés sur cette page avec un lien vers leurs chaînes ';
?>

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
        <?php foreach($channels as $channel): ?> 
            <div class="col-xl-3 mt-4 px-4 py-4 mx-4 border-article">
                <?php require 'cardChannel.php'; ?>
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


<?php 
use App\Connection;
use App\Model\VideoHeader;
$pdo = Connection::getPDO();
$query = $pdo->query(" SELECT * FROM video_header WHERE id");
$query->setFetchMode(PDO::FETCH_CLASS, VideoHeader::class);
$videoHeader=$query->fetch();
if ($videoHeader === false){
    throw new Exception('Données non trouvées');
}

$title = 'Article';
$description = "Conférence scientifique sur les effets de la télévison"

?>
<div class="container my-5" >
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
            <?=html_entity_decode($videoHeader->getI_frame())?>
        </div>
        <div class="col-md-6">
            <h1 ><?= htmlentities($videoHeader->getName_video())?> </h1> 
        
            <p><?= $videoHeader->getContent();?></p>
        </div>
        
        
    </div>  
</div>

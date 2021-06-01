
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            
                <div class="">
                    <h5 class=""><?=htmlentities($videoHeader->getName_video());?></h5>
                    <p class="card-text"><?= $videoHeader->getExcerpt();?></p>
                    <a class="btn button" href="<?= $router->url('video_header'); ?>"> 
                        Voir Vidéo
                    </a>
                </div>
                
            
        </div>
        <div class="col-md-4">
        <img class="mx-auto d-block" src="/uploads/img-divers/img-fauteuil.png" >
        </div>
    </div>
</div>

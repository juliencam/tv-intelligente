<form action="" method="POST" enctype="multipart/form-data">
        <?=$form->input('name_video','Titre de la video');?> 
        <?=$form->input('name_author','Youtubeur');?> 
        <?=$form->input('slug','URL (mettre youtubeur et titre au format slug)');?>

        <div class="row">
            <div class="col-md-9">
                <?=$form->file('image','Image (Doit correspondre à l\'article et à la chaîne youtube. Dimension 400/200 )');?>
            </div>
            <div class="col-md-3">
            <?php if($post->getImage()): ?>
                <img src="<?= $post->getImageURL('small')?>" alt="" style = width:250px>
            <?php endif ;?>
            </div>
        </div>

        <?=$form->inputHTML('i_frame',"Code d 'intégration youtube (Suppression des arguments inutiles)");?> 
        <?=$form->inputHTML('path_youtube',"Lien chaîne youtube (Copie URL par onglet vidéo)");?> 
        <?=$form->input('created_at','Date de création');?> 
        <?=$form->selected('categoriesids','Catégories (Maintenir Ctrl pour sélectionner plusieurs catégories)'
                            ,$categories);?> 
        <?=$form->textarea('content','contenu');?> 
        
    <button class="btn btn-primary" type="submit"><?= ($post->getId()!==null) ? 'Editer' : 'Créer' ?></button>
</form>

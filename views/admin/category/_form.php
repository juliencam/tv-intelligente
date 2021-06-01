<form action="" method="POST">
        <?=$form->input('name','Nom de la categorie');?> 
        <?=$form->input('slug','URL (format slug)');?>
    <button class="btn btn-primary" type="submit"><?= ($category->getId()!==null) ? 'Editer' : 'Créer' ?></button>
</form>

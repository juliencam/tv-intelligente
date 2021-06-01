<?php
use App\Auth;
use App\Connection;
use App\Table\CategoryTable;

Auth::check();

$title = 'Gestion des catégories';

$pdo = Connection::getPDO();

$table = new CategoryTable($pdo);
$categories = $table->all();

?>
<?php if(isset($_GET['delete'])): ?>
  <div class="alert alert-success">
    L'enregistrement a bien été supprimé
  </div>
<?php endif; ?>

<table class="table">
  <thead>
    <tr>
      <th>ID#</th>
      <th>Titre</th>
      <th>URL</th>
      <th><a href="<?=$router->url('new_category_admin'); ?>" class="btn btn-primary">Créer</a></th>
      
    </tr>
  </thead>
  <tbody>
   

    <?php foreach($categories as $category): ?> 
      
      <tr>
        <td>
          <?=$category->getId()?>
        </td>
        <td>
          <a href="<?=$router->url('edit_category_admin', ['id'=>$category->getId()]); ?>">
            <?=htmlentities($category->getName())?>
          </a>
        </td>
        <td>
          <?=$category->getSlug()?>
        </td>
        <td>
          <a href="<?=$router->url('edit_category_admin', ['id'=>$category->getId()]); ?>" class="btn btn-primary">
            Editer
          </a>
        </td>
        <td>
          <form action="<?=$router->url('delete_category_admin', ['id'=>$category->getId()]); ?>" method="POST" 
             onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')" style="display:inline">
              <button type="submit" class="btn btn-danger"> Supprimer</button>
          </form>
        </td>
      </tr>

    <?php endforeach; ?>
  </tbody>
</table>
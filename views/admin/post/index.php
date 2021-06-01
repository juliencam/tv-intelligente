<?php
use App\Auth;
use App\Connection;
use App\Table\PostTable;

Auth::check();

$title = 'administration';

$pdo = Connection::getPDO();

$table = new PostTable($pdo);
[$posts, $pagination] = $table->findPaginated();

$link = $router->url('index_admin');

?>
<?php if(isset($_GET['delete'])): ?>
  <div class="alert alert-success">
    L'enregistrement a bien été supprimé
  </div>
<?php endif; ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID#</th>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col"> <a href="<?=$router->url('new_admin'); ?>" class="btn btn-primary">Créer</a></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
   

    <?php foreach($posts as $post): ?> 
      
      <tr>
        <td>
          <?=$post->getId()?>
        </td>
        <td>
          <a href="<?=$router->url('edit_admin', ['id'=>$post->getId()]); ?>">
            <?=htmlentities($post->getName_video())?>
          </a>
        </td>
        <td>
          <?=htmlentities($post->getName_author())?>
        </td>
        <td>
          <a href="<?=$router->url('edit_admin', ['id'=>$post->getId()]); ?>" class="btn btn-primary">
            Editer
          </a>
        </td>
        <td>
          <form action="<?=$router->url('delete_admin', ['id'=>$post->getId()]); ?>" method="POST" 
             onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')" style="display:inline">
              <button type="submit" class="btn btn-danger"> Supprimer</button>
          </form>
        </td>
      </tr>

    <?php endforeach; ?>
  </tbody>
</table>

<div class="d-flex justify-content-between my-4">
     <?= $pagination->previousLink($link, 'btn-primary'); ?>
     <?= $pagination->nextLink($link , 'btn-primary'); ?>
</div>
<?php
use App\Auth;
use App\HTML\Form;
use App\Connection;
use App\ObjectHelpers;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Validator\PostValidator;
use App\Attachment\PostAttachment;

Auth::check();

$id = (int)$params['id'];

$success = false;

$errors = [];

$pdo = Connection::getPDO();

$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post = $postTable->find($id);
$categoryTable->hydratePosts([$post]);


if(!empty($_POST)){
    $data = array_merge($_POST, $_FILES);
    $validator = new PostValidator($data, $postTable, $post->getId(), $categories);
   
    ObjectHelpers::hydrate($post, $data, ['name_video','name_author','i_frame','path_youtube','content',
                                          'slug','created_at','image']);
        if($validator->validate())
        {
        $success =true;
        $pdo->beginTransaction();
        PostAttachment::upload($post);
        $postTable->updatePost($post);
        $postTable->attachCategories($post->getId(), $_POST['categoriesids']);
        $pdo->commit();
        $categoryTable->hydratePosts([$post]);
   
        } else {
            $errors = ($validator->errors());
            $success =false; 
        }
    }

$form = new Form($post,$errors);
?>
<?php if(!empty($_POST)): ?>

    <?php if($success) :?>

        <div class="alert alert-success">
            <p>L'article à bien été modifié</p>
        </div>

        <?php elseif($success===false):?>

        <div class="alert alert-danger">
            <p>L'article n'a pas pu être modifié</p>
        </div>

    <?php endif;?>

<?php endif ?>    

<?php if(isset($_GET['created'])) :?>

<div class="alert alert-success">
    <p>L'article à bien été créer</p>
</div>

<?php endif;?>

<h1> Editer l'article ID : <?= $post->getId()?></h1>
<?php require '_form.php';?>
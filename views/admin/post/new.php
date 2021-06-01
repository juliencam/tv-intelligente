<?php

use App\Auth;
use App\HTML\Form;
use App\Connection;
use App\Model\Post;
use App\ObjectHelpers;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Validator\PostValidator;
use App\Attachment\PostAttachment;

Auth::check();

$errors = [];

$succes =false;
$pdo = Connection::getPDO();
$post = new Post();

$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();

if(!empty($_POST)){
    $data = array_merge($_POST, $_FILES);
    $postTable= new PostTable($pdo); 
    $validator = new PostValidator($data, $postTable , $post->getId(),$categories);
    ObjectHelpers::hydrate($post, $data, ['name_video','name_author','i_frame','path_youtube','content',
                            'slug','created_at','image']);
    if($validator->validate())
    {
    $pdo->beginTransaction();
    PostAttachment::upload($post);
    $postTable->createPost($post);
    $postTable->attachCategories($post->getId(), $_POST['categoriesids']);
    $pdo->commit();
    header('Location: ' . $router->url('edit_admin', ['id'=>$post->getId()]). '?created=1');
    exit();
    } else {
        $errors = ($validator->errors());
        $success =false; 
    }
 
}
$form = new Form($post,$errors);
?>

<?php if(!empty($_POST)): ?>
 
        <?php if($success===false):?>

        <div class="alert alert-danger">
            <p>L'article n'a pas pu être enregistré, corrigez vos erreurs</p>
        </div>

    <?php endif;?>
<?php endif ?> 

<h1> Créer article</h1>
<?php require '_form.php';?>
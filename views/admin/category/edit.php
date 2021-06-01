<?php
use App\Auth;
use App\HTML\Form;
use App\Connection;
use App\ObjectHelpers;
use App\Table\CategoryTable;
use App\Validator\CategoryValidator;

Auth::check();

$id = (int)$params['id'];

$success = false;

$errors = [];

$pdo = Connection::getPDO();

$categoryTable = new CategoryTable($pdo);
$category = $categoryTable->find($id);


if(!empty($_POST)){
   
    $validator = new CategoryValidator($_POST, $categoryTable , $category->getId());
    ObjectHelpers::hydrate($category, $_POST, ['name','slug']);
    if($validator->validate())
    {
    $success =true;    
    $categoryTable->update([
        'name'=>$category->getName(),
        'slug'=>$category->getSlug()
    ],$category->getId());
    } else {
        $errors = ($validator->errors());
        $success =false; 
    }
}

$form = new Form($category,$errors);
?>
<?php if(!empty($_POST)): ?>

    <?php if($success) :?>

        <div class="alert alert-success">
            <p>La catégorie à bien été modifié</p>
        </div>

        <?php elseif($success):?>

        <div class="alert alert-danger">
            <p>La catégorie n'a pas pu être modifié</p>
        </div>

    <?php endif;?>

<?php endif ?>    

<?php if(isset($_GET['created'])) :?>

<div class="alert alert-success">
    <p>L'article à bien été créer</p>
</div>

<?php endif;?>

<h1> Editer la catégorie ID : <?= $category->getId()?></h1>
<?php require '_form.php';?>
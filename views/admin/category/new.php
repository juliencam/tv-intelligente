<?php

use App\Auth;
use App\HTML\Form;
use App\Connection;
use App\ObjectHelpers;
use App\Model\Category;
use App\Table\CategoryTable;
use App\Validator\CategoryValidator;

Auth::check();

$errors = [];

$succes =false;

$category = new Category();

if(!empty($_POST)){
    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo); 
    $validator = new CategoryValidator($_POST, $table );
    ObjectHelpers::hydrate($category, $_POST, ['name','slug']);
    if($validator->validate())
    {
    $pdo->beginTransaction();
    $table->create([
        'name'=> $category->getName(),
        'slug'=>$category->getSlug()
    ]);
    $pdo->commit();
    header('Location: ' . $router->url('index_category_admin'). '?created=1');
    exit();
    } else {
        $errors = ($validator->errors());
        $success =false; 
    }
 
}
$form = new Form($category,$errors);
?>

<?php if(!empty($_POST)): ?>
 
        <?php if($success===false):?>

        <div class="alert alert-danger">
            <p>La catégorie n'a pas pu être enregistré, corrigez vos erreurs</p>
        </div>

    <?php endif;?>
<?php endif ?> 

<h1> Créer une catégorie</h1>
<?php require '_form.php';?>
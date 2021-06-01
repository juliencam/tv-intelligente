<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title><?= isset($title) ? htmlentities($title) : 'TV_intelligente';  ?></title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="https://placehold.co/10x10" />
</head>
<body class="d-flex flex-column h-100" >

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a href="<?= $router->url('home')?>" class="navbar-brand">Accueil</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= $router->url('index_admin')?>">Articles</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?= $router->url('index_category_admin')?>">Catégories</a>
            </li>
            <li class="nav-item">
                <form action="<?=$router->url('logout')?>" method="POST" style ="display:inline">
                    <button type = "submit" class="nav-link" style="background:transparent; border:none;">Se déconnecter</button>
                </form>
            </li>
        </ul>
    </nav>
    

    <div class="container mt-4">
        <?= $content; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>


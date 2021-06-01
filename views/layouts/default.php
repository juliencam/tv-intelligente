<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="jCwu5UzeVOsqdqaaznWLqscY0AGbvauSytVvZBu5Vfs" />
    <meta name="publisher" content="Julien Cambien" >
    <meta name="author" content="Julien Cambien" >
    <meta name="revisit-after" content="14 days">
    <title><?= isset($title) ? htmlentities($title) : 'TV_intelligente';  ?></title>
    <meta name="description" content="<?=isset($description)? htmlentities($description):'Une web TV intelligente qui référence du contenu youtube'?>"> 
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" href="../uploads/fav_icon/logo.png" />


    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177766900-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-177766900-1');
</script>

</head>

<body class="" >
    <header>
    <div class="container-fluid bg-header" style="height: 300px;">
    
        
        
    
    </div>
        
        <div class="container-fluid" >
            
                <div class="row align-items-center justify-content-center">
                        <div class="col-12 bg-image-header" style="height: 400px;">

                            <div class="container">
                                <div class="row align-items-center justify-content-center" style="height: 400px;">
                                    <div class="padding-nav" >
                                    
                                        <nav class="nav flex-column align-content-center text-center" style="width: 200px;">
                                        <a class="font-nav nav-link " href="<?= $router->url('home')?>">Accueil</a>
                                        <a class="font-nav nav-link" href="<?= $router->url('categories')?>">Catégories</a>
                                        <a class="font-nav nav-link" href="<?= $router->url('channels')?>">Chaînes Youtube</a>
                                        </nav>
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        
            
                </div>

                
        </div>

    </header>


    <div class="my-5">
        <?= $content; ?>
    </div>

    <footer class="bg-image-footer">
        <div class="container-fluid color-article border-top">
           <div class="row justify-content-center align-items-center text-center" style="height: 200px;">
               <div class="col-md-4">
                   <a class="btn button btn-footer" href="<?= $router->url('a_propos')?>">
                    A Propos</a>
                    </div>
               <div class="col-md-4">
                   <a class="btn button btn-footer" href="https://twitter.com/tvintelligente" target="_blank">
                   Twitter
                    </a>
                </div>
               <div class="col-md-4">
                   <a class="btn button btn-footer" href="<?= $router->url('mentions_legales')?>">
                   Mentions légales
                    </a> 
                </div>
           </div>     
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>


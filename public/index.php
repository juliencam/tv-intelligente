<?php 
use App\Router;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
require '../vendor/autoload.php';

error_reporting(0);

define('UPLOAD_PATH', __DIR__ . DIRECTORY_SEPARATOR. 'uploads');

if (isset($_GET['page']) && $_GET['page']==='1'){
    $uri = explode('?',$_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if(!empty($query)){
        $uri =$uri .'?'. $query;
    }
    http_response_code(301);
    header('Location:'.$uri);
    exit();
}

$router = new Router(dirname(__DIR__). DIRECTORY_SEPARATOR . 'views');
$router
    ->get('/', 'post/index', 'home' )
    ->get('/post/[*:slug]-[i:id]', 'post/show', 'post_show' )
    ->get('/categories', 'category/index', 'categories' )
    ->get('/categorie/[*:slug]-[i:id]', 'category/show', 'categorie' )
    ->get('/chaines_youtube', 'channel/index', 'channels' )
    ->get('/video_en_tete', 'post/showHeaderHome', 'video_header' )
    //login
    ->match('/login', 'auth/login', 'login' )
    ->post('/logout','auth/logout', 'logout' )
    //admin post
    ->get('/admin', 'admin/post/index', 'index_admin' )
    ->match('/admin/post/[i:id]', 'admin/post/edit', 'edit_admin' )
    ->match('/admin/post/new', 'admin/post/new', 'new_admin' )
    ->post('/admin/post/delete/[i:id]', 'admin/post/delete', 'delete_admin' )
    //admin categories
    ->get('/admin/category', 'admin/category/index', 'index_category_admin' )
    ->match('/admin/category/[i:id]', 'admin/category/edit', 'edit_category_admin' )
    ->match('/admin/category/new', 'admin/category/new', 'new_category_admin' )
    ->post('/admin/category/delete/[i:id]', 'admin/category/delete', 'delete_category_admin')
    //footer
    ->get('/mentions_legales', 'footer_link/mentions_legales', 'mentions_legales')
    ->get('/a_propos', 'footer_link/a_propos', 'a_propos')
    ->run();


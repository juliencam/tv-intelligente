<?php

use App\Attachment\PostAttachment;
use App\Auth;
use App\Connection;
use App\Table\PostTable;

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);
PostAttachment::detach($post);

$table->delete($params['id']);
$table->deleteLinkTable($params['id']);

header('Location:' . $router->url('index_admin') .'?delete=1');
exit();
?>

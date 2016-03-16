<?php
define('PATH_ROOT', __DIR__ . '/../');
require PATH_ROOT . '/autoload.php';

use \App\Models\News;

$article = News::findById($_GET['id']);

var_dump($article);
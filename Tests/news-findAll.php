<?php
define('PATH_ROOT', __DIR__ . '/../');
require PATH_ROOT . '/autoload.php';

use \App\Models\News;

$news = News::findAll();
var_dump($news);


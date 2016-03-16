<?php
define('PATH_ROOT', __DIR__ . '/../');
require PATH_ROOT . '/autoload.php';

use \App\Models\News;

$news = News::findLatest($_GET['limit']);
var_dump($news);
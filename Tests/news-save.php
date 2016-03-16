<?php
define('PATH_ROOT', __DIR__ . '/../');
require PATH_ROOT . '/autoload.php';

use \App\Models\News;

/**
 * @var News $article
 */
$article = new News();

foreach ($_GET as $k => $v) {
    $article->$k = $v ?: (isset(News::$byDefault[$k]) ? News::$byDefault[$k] : null);
}
$article->save();

var_dump($_GET);
var_dump($article);
var_dump(News::findById($article->id));

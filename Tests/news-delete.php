<?php
define('PATH_ROOT', __DIR__ . '/../');
require PATH_ROOT . '/autoload.php';

use \App\Models\News;

/**
 * @var News $article
 */
if ($article = News::findById($_GET['id'])) {
    $article->delete();
    echo 'Новость № ' . $_GET['id'] . ' удалена.';
} else {
    echo 'Новость № ' . $_GET['id'] . ' не найдена.';
}


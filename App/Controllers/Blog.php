<?php

namespace App\Controllers;

use \App\Models\News;
use App\Exceptions\E404;

/**
 * Class Blog
 * @package App\Controllers
 */
class Blog extends Base
{
    protected function actionIndex()
    {
        $this->view->news = News::findLatest(3);
        $this->view->display(PATH_ROOT . '/App/templates/index.php');
    }

    protected function actionArticle()
    {
        if (false === ($this->view->article = News::findByID($_GET['id']))) {
            throw  new E404('Ошибка 404 - не найдено.');
        }
        $this->view->display(PATH_ROOT . '/App/templates/article.php');
    }

}
<?php

namespace App\Controllers;

use App\Classes\Application;
use App\Classes\AdminDataTable;
use App\Exceptions\EMulti;
use \App\Models\News;
use \App\Models\Author;

/**
 * Class admin
 * @package App\Controllers
 */
class Admin extends Check
{
    protected function actionAll()
    {
        $news = \App\Models\News::findAll();
        $dataTable = new AdminDataTable(
            $news,
            function ($article) {
                return $article->id;
            },
            function ($article) {
                return $article->title;
            },
            function ($article) {
                return $article->created_at;
            },
            function ($article) {
                return $article->source;
            },
            function ($article) {
                return $article->text;
            },
            function ($article) {
                return $article->author->name;
            }
        );
        $this->view->news = $dataTable->render();
        $this->view->display(PATH_ROOT . '/App/templates/admin-table.php');
    }

    protected function actionEdit()
    {
        $this->view->authors = Author::findAll();
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET' :
                $this->view->article = isset($_GET['id']) ? News::findByID($_GET['id']) : new News();
                break;
            case  'POST' :
                $article = !empty($_POST['id']) ? News::findByID($_POST['id']) : new News();
                try {
                    $article->fill($_POST);
                    $article->save();
                    Application::redirect('/blog/article/?id=' . $article->id);
                } catch (EMulti $e) {
                    $this->view->article = $article;
                    $this->view->errors = $e;
                }
                break;
            default :
                break;
        }
        $this->view->display(PATH_ROOT . '/App/templates/edit.php');
    }

    protected function actionDelete()
    {
        News::findById($_GET['id'])->delete();
        Application::redirect('/admin/all/');
    }

}
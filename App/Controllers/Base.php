<?php

namespace App\Controllers;

use \App\Classes\Application;
use \App\Classes\View;
use \App\Classes\Logger;

/**
 * @package App\Controllers
 */
class Base
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @param $action
     * @return mixed
     */
    public function action($action)
    {
        $methodName = 'action' . $action;
        if (!method_exists($this, $methodName)) {
            $location = (static::class == 'App\Controllers\Admin') ? '/admin/all/' : '/';
            Application::redirect($location);
        };
        $this->beforeAction();
        return $this->$methodName();
    }

    protected function beforeAction()
    {
    }

    public function exceptionsHandler(\Exception $e)
    {
        Logger::instance()->error($e->getMessage(), [$e]);
        $this->view->error = $e;
        $this->view->display(PATH_ROOT . '/App/templates/exception.php');
    }

}
<?php
const PATH_ROOT = __DIR__ . '/../';
require PATH_ROOT . '/autoload.php';

use \App\Classes\Application;
use \App\Controllers\Admin;
use \App\Controllers\Base;

/**
 * @var string $action
 * @var Admin $controller
 */

$urlParts = Application::getUrlArray($_SERVER['REQUEST_URI']);

if ('admin' !== array_shift($urlParts)) {
    Application::redirect('/');
} else {
    // проверка авторизации / авторизация
    $action = ucfirst(array_pop($urlParts));
    if (empty($action)) {
        $action = 'All';
    } elseif ($action[0] == '?') {
        $action = ucfirst(array_pop($urlParts));
    }
    try {
        $controller = new Admin();
        $controller->action($action);
    } catch (\App\Exceptions\EDb $e) {
        (new Base())->exceptionsHandler($e);
    } catch (\App\Exceptions\E404 $e) {
        (new Base())->exceptionsHandler($e);
    }
}

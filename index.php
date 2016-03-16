<?php
const PATH_ROOT = __DIR__;
require PATH_ROOT . '/autoload.php';

use \App\Classes\Application;
use \App\Controllers\Base;

/**
 * @var string $action
 * @var Base $controller
 */

$urlParts = Application::getUrlArray($_SERVER['REQUEST_URI']);

if (empty($urlParts[0])) {
    $class = '\\App\\Controllers\\Blog';
    $action = 'Index';
} else {
    $urlParts = array_map(function ($a) {
        return ucfirst($a);
    }, $urlParts);
    $action = array_pop($urlParts);
    if ($action[0] == '?') {
        $action = array_pop($urlParts);
    }
    $class = '\\App\\Controllers\\' . implode($urlParts, '\\');
}
try {
    if (class_exists($class) !== false) {
        $controller = new $class();
        $controller->action($action);
    } else {
        throw new \App\Exceptions\E404('Ошибка 404 - не найдено.');
    }
} catch (\App\Exceptions\EDb $e) {
    (new Base())->exceptionsHandler($e);
} catch (\App\Exceptions\E404 $e) {
    (new Base())->exceptionsHandler($e);
}





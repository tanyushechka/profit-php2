<?php
define('PATH_ROOT', __DIR__ . '/../');
require PATH_ROOT . '/autoload.php';
use \App\Models\User;

ob_start();
$users = User::findAll();
foreach ($users as $user) {
    foreach ($user as $value) {
        var_dump($value);
    }
}
$content = ob_get_contents();
ob_end_clean();
echo $content;
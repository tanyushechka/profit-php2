<?php
define('PATH_ROOT', __DIR__ . '/../');
require PATH_ROOT . '/autoload.php';

use \App\Models\User;

$users = User::findAll();
var_dump($users);
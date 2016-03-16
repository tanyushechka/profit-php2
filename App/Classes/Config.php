<?php

namespace App\Classes;

class Config
{
    use TSingleton;

    public $data = [];

    protected function __construct()
    {
        $this->data = include PATH_ROOT . '/config.php';
    }
}
<?php

namespace App\Classes;

trait TMagic

{
    protected $data = [];

    /**
     * @param string $key
     * @param mixed $val
     * @return void
     */
    public function __set($key, $val)
    {
        $this->data[$key] = $val;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->data[$key];
    }

    /**
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }
}


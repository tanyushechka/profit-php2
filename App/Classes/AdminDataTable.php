<?php

namespace App\Classes;

class AdminDataTable
{
    private $models;
    private $functions;

    public function __construct(array $models, callable ...$functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }

    public function render()
    {
        $result = [];
        foreach ($this->models as $i => $model) {
            foreach ($this->functions as $function) {
                $result[$i][] = $function($model);
            }
        }
        return $result;
    }
}
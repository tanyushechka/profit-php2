<?php
namespace App\Classes;

interface ILogger
{
    public function logToJson(\Exception $e);
}
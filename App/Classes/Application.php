<?php

namespace App\Classes;


class Application
{
    public static function redirect($location)
    {
        header('Location: ' . $location);
        exit;
    }

    public static function getUrlArray($urlPath)
    {
        $url = parse_url($urlPath, PHP_URL_PATH);
        return explode('/', trim($url, '/'));
    }

    /**
     * @param $fileName
     */
    public static function createFile($fileName)
    {
        if (!file_exists($fileName)) {
            $res = fopen($fileName, 'a');
            fclose($res);
        }
    }

}
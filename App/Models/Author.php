<?php

namespace App\Models;

use App\Classes\Db;
use App\Classes\Model;

class Author extends Model

{
    const TABLE = 'authors';

    public $name;


    public static function findByName(string $name = '')
        /**
         * @return mixed
         * @var Db $db
         */
    {
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM ' . self::TABLE . ' WHERE `name` = :name',
            self::class,
            [':name' => $name]
        );
        return count($res) === 1 ? $res[0] : false;
    }

}
<?php

namespace App\Models;

use App\Classes\Db;
use App\Classes\Model;
use App\Exceptions\E404;

/**
 * Class News
 * @package App\Models
 */
class News extends Model
{
    const TABLE = 'news';
    public static $isNull = ['id', 'author_id', 'source', 'created_at'];
    public static $byDefault = ['text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aut, blanditiis deleniti,
    dolorem eaque error esse facilis illo impedit laborum nemo numquam odit omnis quod saepe, totam veritatis vero voluptates?'];

    public $author_id;
    public $title;
    public $created_at;
    public $source;
    public $text;

    /**
     * @return array
     */
    public static function findLatest(int $limit = 3)
        /**
         * @return array
         * @var Db $db
         */
    {
        $db = Db::instance();
        $res = $db->queryEach(
            'SELECT * FROM ' . self::TABLE . ' ORDER BY `created_at` DESC LIMIT 0, :limit',
            self::class,
            [':limit' => $limit]
        );
//        if (empty($res)) {
//            throw new E404('Полное отсутствие новостей.');
//        }
        return $res;
    }

    /**
     * @param int $key
     * @return Author
     */
    public function __get($key)
    {
        switch ($key) {
            case 'author' :
                return Author::findById($this->author_id);
                break;
            default :
                return null;
                break;
        }
    }

    /**
     * @param int $key
     * @return bool
     */
    public function __isset($key)
    {
        switch ($key) {
            case 'author' :
                return !empty($this->author_id);
                break;
            default :
                return false;
                break;
        }
    }

}
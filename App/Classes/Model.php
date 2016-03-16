<?php

namespace App\Classes;

use \App\Exceptions\EMulti;

abstract class Model
{
    const TABLE = '';

    public $id;
    public static $isNull = [];
    public static $byDefault = [];


    /**
     * @return array
     */
    public static function findAll()
    {
        /**
         * @var Db $db
         */
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' ORDER BY `id` DESC',
            static::class
        );
//        if (empty($res)) {
//            throw new E404('Ничего нет в таблице ' . static::TABLE);
//        }
    }

    /**
     * @return mixed
     */
    public static function findById($id)
    {
        /**
         * @var Db $db
         */
//        if (!is_numeric($id)) {
//            throw new E404('Номер должен быть числом.');
//        }
        $db = Db::instance();
        $res = $db->query(
            'SELECT * FROM `' . static::TABLE . '` WHERE `id` = :id',
            static::class,
            [':id' => (int)$id]);
        return count($res) === 1 ? $res[0] : false;
    }

    /**
     * @return boolean
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * @return void
     */
    public function save()
    {
        if ($this->isNew()) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * @return void
     */
    public function update()
    {
        /**
         * @var Db $db
         */
        $properties = get_object_vars($this);
        unset($properties['id']);
        $columns = array_keys($properties);
        $places = [];
        $data = [];
        foreach ($columns as $property) {
            $places[] = '`' . $property . '` = :' . $property;
            $data[':' . $property] = $this->$property;
        }
        $data[':id'] = (int)$this->id;
        $sql = 'UPDATE `' . static::TABLE . '` SET ' . implode(', ', $places) . ' WHERE `id` = :id';
        $db = Db::instance();
        $db->execute($sql, $data);
    }

    /**
     * @return void
     */
    public function insert()
    {
        /**
         * @var Db $db
         */
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k || is_null($this->$k)) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }
        $sql = 'INSERT INTO ' . static::TABLE . '(' . implode(',', $columns) . ')VALUES(' . implode(',', array_keys($values)) . ')';
        $db = Db::instance();
        $db->execute($sql, $values);
        $this->id = $db->lastId();
    }

    /**
     * @return boolean
     */
    public function delete()
    {
        /**
         * @var Db $db
         */
        $sql = 'DELETE FROM `' . static::TABLE . '` WHERE `id` = :id';
        $db = Db::instance();
        return $db->execute($sql, [':id' => $this->id]);
    }

    public function fill($post)
    {
        $arrPost = array_map(function ($val) {
            return trim($val);
        }, $post);
        $arrEmpty = array_keys($arrPost, '');
        if (empty($arrEmpty) || empty(array_diff($arrEmpty, static::$isNull, array_keys(static::$byDefault)))) {
            foreach ($post as $key => $val) {
                $this->$key = $val ?: (isset(static::$byDefault[$key]) ? static::$byDefault[$key] : null);
            }
            return;
        }
        $e = new EMulti();
        foreach ($arrEmpty as $item) {
            if (!(in_array($item, static::$isNull) || in_array($item, array_keys(static::$byDefault)))) {
                $e[] = new \Exception('Не заполнено обязательное поле ' . $item);
            }
        }
        throw $e;
    }

}
<?php

namespace App\Models;

use App\Classes\Model;

/**
 * Class User
 * @package App\Models
 */
class User extends Model
{
    const TABLE = 'users';
    public static $isNull = ['id', 'last_name', 'created_at'];
    public static $byDefault = ['email' => 'tat.dobrolyubova@yandex.ru', 'first_name' => 'unknown'];

    public $username;
    public $email;
    public $password;
    public $created_at;
    public $first_name;
    public $last_name;

}
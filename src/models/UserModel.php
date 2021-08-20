<?php

namespace app\models;

use app\components\Model;

class UserModel extends Model
{
    public $attributes = [
        'id' => '',
        'firstname' => '',
        'middlename' => '',
        'lastname' => '',
        'email' => ''
    ];

    public static function tableName(): string
    {
        return 'users';
    }
}
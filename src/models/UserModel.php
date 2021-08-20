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

    public $relationModels = [
        'hasOne' => [],
        'hasMany' => [],
    ];

    protected $relations = [
        'hasOne' => [],
        'hasMany' => [
            UserGroupsModel::class => ['id' => 'user_id'],
        ],
    ];

    public static function tableName(): string
    {
        return 'users';
    }
}
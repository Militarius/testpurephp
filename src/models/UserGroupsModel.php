<?php

namespace app\models;

use app\components\Model;

class UserGroupsModel extends Model
{
    public $attributes = [
        'user_id' => '',
        'group_id' => '',
    ];

    public static function tableName(): string
    {
        return 'users_groups';
    }
}
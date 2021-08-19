<?php

namespace app\models;

use app\components\Model;

class GroupModel extends Model
{
    public $attributes = [
        'id' => '',
        'name' => '',
        'description' => ''
    ];

    public static function tableName(): string
    {
        return 'Groups';
    }
}
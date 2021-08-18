<?php

namespace app\components;

class DBConnection extends \PDO
{
    public function __construct()
{
    $db_config = include dirname(__DIR__) . '/config/db.php';

    parent::__construct($db_config['dsn'], $db_config['username'], $db_config['password']);
}
}
<?php

namespace app\components;

use Exception;

class Application
{
    /** @var DBConnection $connection */
    public $connection;

    public function __construct()
    {
        $this->connection = new DBConnection();

        $this->setRoutes();
    }

    /**
     * @throws Exception
     */
    public function __destruct()
    {
        Router::execute($_SERVER['REQUEST_URI']);
    }

    private function setRoutes(): void
    {
        $routes = include dirname(__DIR__) . '/config/routes.php';
        foreach ($routes as $pattern => $callback) {
            Router::route($pattern, $callback);
        }
    }
}
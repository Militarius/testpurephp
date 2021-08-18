<?php

namespace app\components;


use Exception;

class Router
{
    private static $routes = [];

    private function __construct() {}

    private function __clone() {}

    public static function route($pattern, $callback): void
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';

        static::$routes[$pattern] = $callback;
    }

    /**
     * @throws Exception
     */
    public static function execute($url)
    {
        foreach (static::$routes as $pattern => $callback) {
            if(preg_match($pattern, $url, $params)) {
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }
        }
        print 'Page not found!';
    }
}
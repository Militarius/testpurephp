<?php

use app\controllers\DefaultController;

return [
    '/' => static function() {
        (new DefaultController())->groups();//index();
    },
    '/groups' => static function() {
        (new DefaultController())->groups();
    },
    '/group/(\d+)' => static function($id) {
        return (new DefaultController())->groups($id);
    },
    '/users' => static function() {
        return (new DefaultController())->users();
    },
    '/users/(\d+)' => static function($id) {
        return (new DefaultController())->users($id);
    },
    '/send_notify' => static function() {
        return (new DefaultController())->send_notify();
    },
    '/send_notify/(\d+)' => static function($id) {
        return (new DefaultController())->send_notify($id);
    },
    '/test' =>  static function() {
        return (new DefaultController())->test();
    },
];
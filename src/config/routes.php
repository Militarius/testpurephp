<?php

use app\controllers\DefaultController;

return [
    // Основной роут
    '/' => static function() {
        (new DefaultController())->groups();//index();
    },

    // Роуты для групп
    '/groups' => static function() {
        (new DefaultController())->groups();
    },
    '/group/create' => static function() {
        (new DefaultController())->groupCreate();
    },
    '/group/update/(\d+)' => static function($id) {
        (new DefaultController())->groupUpdate($id);
    },
    '/group/delete' => static function() {
        (new DefaultController())->groupDelete();
    },
    '/group/delete/(\d+)' => static function($id) {
        (new DefaultController())->groupDelete($id);
    },

    // Роуты для пользователей
    '/users' => static function() {
        (new DefaultController())->users();
    },
    '/user/create' => static function() {
        (new DefaultController())->userCreate();
    },
    '/user/update/(\d+)' => static function($id) {
        (new DefaultController())->userUpdate($id);
    },
    '/user/delete/' => static function() {
        (new DefaultController())->userDelete();
    },
    '/user/delete/(\d+)' => static function($id) {
        (new DefaultController())->userDelete($id);
    },

    // Роуты для уведомлений
    '/send_notify' => static function() {
        return (new DefaultController())->sendNotify();
    },

    // Прочие роуты
    '/test' =>  static function() {
        return (new DefaultController())->test();
    },
];
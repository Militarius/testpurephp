<?php

use app\controllers\DefaultController;

return [
    '/' => static function() {
        return (new DefaultController())->index();
    },
    '/test' => static function() {
        return (new DefaultController())->test();
    }
];
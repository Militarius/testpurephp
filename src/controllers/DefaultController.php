<?php

namespace app\controllers;

class DefaultController
{
    private const LAYOUT_PAGE = __DIR__ . '/../views/layouts/layout.php';

    public $title = 'DefaultController';

    public $content = '';

    public function index()
    {
        $this->title = 'Главная';
        return $this->render('index', ['content' => 'KOKO']);
    }

    public function test()
    {
        $this->title = 'Test';
        return $this->renderAjax('test', []);
    }

    public function render($page, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        $data = require static::LAYOUT_PAGE;
        $this->content = require __DIR__ . "/../views/default/{$page}.php";
        print ob_get_clean();

        return $data;
    }

    public function renderAjax($page, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        $data =  require __DIR__ . "/../views/default/{$page}.php";
        print ob_get_clean();

        return $data;
    }
}
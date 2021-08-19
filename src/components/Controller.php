<?php

namespace app\components;

class Controller
{
    protected const LAYOUT_PAGE = __DIR__ . '/../views/layouts/layout.php';

    public $title = 'Controller';

    public function render($page, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);
        $data = require static::LAYOUT_PAGE;
        echo ob_get_clean();

        return $data;
    }

    public function renderAjax($page, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);

        $data =  $this->getContent($page, $params);
        echo ob_get_clean();

        return $data;
    }

    public function getContent($page_or_content, $params = [], $is_page = true)
    {
        if($is_page) {
            extract($params, EXTR_OVERWRITE);
            return require __DIR__ . "/../views/default/{$page_or_content}.php";
        }
        return $page_or_content;
    }
}
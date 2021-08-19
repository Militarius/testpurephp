<?php

namespace app\controllers;

use app\components\Controller;
use app\models\GroupModel;

class DefaultController extends Controller
{

    public $title = 'DefaultController';

    public function index()
    {
        $this->title = 'Главная';
        return $this->render('index', ['content' => 'KOKO']);
    }

    public function groups()
    {
        $this->title = 'Группы';
        $model = new GroupModel();

        return $this->render('groups', ['models' => $model->findAll()]);
    }

    public function test()
    {
        $this->title = 'Test';
        return $this->renderAjax('test', []);
    }


}
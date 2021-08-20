<?php

namespace app\controllers;

use app\components\Controller;
use app\models\GroupModel;
use app\models\UserModel;

class DefaultController extends Controller
{

    public $title = 'DefaultController';

    public function test()
    {
        $this->title = 'Test';
        return $this->renderAjax('test', []);
    }


    // ================================== Экшены для групп ====================================
    public function groups()
    {
        $this->title = 'Группы';
        $model = new GroupModel();

        return $this->render('groups', ['models' => $model->findAll()]);
    }

    public function groupCreate()
    {
        $this->title = 'Создание группы';
        $model = new GroupModel();

        if($post = $_POST) {
            $model->attributes = $post;
            $model->insert();
            $this->redirect('groups');
        }

        return $this->render('group_edit', ['model' => $model]);
    }

    public function groupUpdate($id)
    {
        $this->title = 'Редактирование группы';

        $model = (new GroupModel())->findOne(['id' => $id]);

        if($post = $_POST) {
            $model->attributes = $post;
            $model->update(['id' => $id]);
            $this->redirect('groups');
        }
        return $this->render('group_edit', ['model' => $model]);
    }

    public function groupDelete($id = null): void
    {
        if(is_null($id)) {
            if($ids = $_POST['id']) {
                $id = json_decode($ids, true);
            } else {
                $this->redirect('groups');
            }
        }

        $model = new GroupModel();

        $model->delete(['id' => $id]);

        $this->redirect('groups');
    }

    // ================================== Экшены для пользователей ====================================
    public function users()
    {
        $this->title = 'Пользователи';
        $model = new UserModel();

        return $this->render('users', ['models' => $model->findAll()]);
    }

    public function userCreate()
    {
        $this->title = 'Создание пользователя';
        $model = new UserModel();

        if($post = $_POST) {
            $model->attributes = $post;
            $model->insert();
            $this->redirect('users');
        }

        return $this->render('user_edit', ['model' => $model]);
    }

    public function userUpdate($id)
    {
        $this->title = 'Редактирование пользователя';

        $model = (new UserModel())->findOne(['id' => $id]);

        if($post = $_POST) {
            $model->attributes = $post;
            $model->update(['id' => $id]);
            $this->redirect('users');
        }
        return $this->render('user_edit', ['model' => $model]);
    }

    public function userDelete($id = null): void
    {
        if(is_null($id)) {
            if($ids = $_POST['id']) {
                $id = json_decode($ids, true);
            } else {
                $this->redirect('users');
            }
        }

        $model = new UserModel();

        $model->delete(['id' => $id]);

        $this->redirect('users');
    }


    // ================================== Экшены для отправки уведомлений ====================================
    public function sendNotify()
    {
        //
    }
}
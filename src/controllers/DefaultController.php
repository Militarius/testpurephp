<?php

namespace app\controllers;

use app\components\Controller;
use app\components\MailSender;
use app\models\GroupModel;
use app\models\UserGroupsModel;
use app\models\UserModel;
use app\services\UserGroupService;

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
        $model = new GroupModel();

        if(is_null($id)) {
            if(isset($_POST['ids'])) {
                $id = $_POST['ids'];
                if(is_array($id)) {
                    foreach ($id as $row) {
                        $model->delete(['id' => $row]);
                    }
                }
            } else {
                $this->redirect('groups');
            }
        }



        $model->delete(['id' => $id]);

        $this->redirect('groups');
    }

    // ================================== Экшены для пользователей ====================================
    public function users()
    {
        $this->title = 'Пользователи';
        $model = new UserModel();

        $service = new UserGroupService(
            (new GroupModel())->findAll(),
            (new UserGroupsModel())->findAll()
        );

        return $this->render(
            'users',
            [
                'models' => $model->findAll(),
                'mapperService' => $service,
            ]
        );
    }

    public function userCreate()
    {
        $this->title = 'Создание пользователя';
        $model = new UserModel();

        $service = new UserGroupService(
            (new GroupModel())->findAll(),
            []
        );

        if($post = $_POST) {
            $groups = null;
            if($post['Groups']) {
                $groups = $post['Groups'];
                unset($post['Groups']);
            }

            $model->attributes = $post;
            $model->insert();


            $link = new UserGroupsModel();
            $link->delete(['user_id' => $model->attributes['id']]);
            if($groups) {

                foreach ($groups as $group) {
                    $link->attributes['user_id'] = $model->attributes['id'];
                    $link->attributes['group_id'] = $group;
                    $link->insert();
                }
            }

            $this->redirect('users');
        }

        return $this->render(
            'user_edit',
            [
                'model' => $model,
                'mapperService' => $service
            ]
        );
    }

    public function userUpdate($id)
    {
        $this->title = 'Редактирование пользователя';

        $model = (new UserModel())->findOne(['id' => $id]);

        $service = new UserGroupService(
            (new GroupModel())->findAll(),
            (new UserGroupsModel())->findAll(['user_id' => $id])
        );

        if($post = $_POST) {
            $groups = null;
            if($post['Groups']) {
                $groups = $post['Groups'];
                unset($post['Groups']);
            }
            $model->attributes = $post;
            $model->update(['id' => $id]);

            $link = new UserGroupsModel();
            $link->delete(['user_id' => $id]);
            if($groups) {

                foreach ($groups as $group) {
                    $link->attributes['user_id'] = $id;
                    $link->attributes['group_id'] = $group;
                    $link->insert();
                }

            }

            $this->redirect('users');
        }
        return $this->render(
            'user_edit',
            [
                'model' => $model,
                'mapperService' => $service,
            ]
        );
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
    public function notify()
    {
        $this->title = 'Отправка уведомлений';

        $service = new UserGroupService(
            (new GroupModel())->findAll(),
            (new UserGroupsModel())->findAll(),
            (new UserModel())->findAll()
        );

        return $this->render(
            'notify',
            [
                'mapperService' => $service,
            ]
        );
    }

    public function notifyUserList()
    {
        if($group = $_POST['group']) {

            $service = new UserGroupService(
                (new GroupModel())->findAll(['group_id' => $group]),
                (new UserGroupsModel())->findAll(),
                (new UserModel())->findAll()
            );

            return $this->renderAjax(
                'notify_user_list',
                [
                    'models' => $service->getUsersMap(),
                ]
            );
        }
    }

    public function notifySend()
    {
        if(($users = $_POST['users']) && ($content = $_POST['content'])) {
            $emails = [];
            foreach ($users as $id) {

                $emails[] = (new UserModel())->findOne(['id' => $id])->attributes['email'];
            }

            $mailer = new MailSender($emails, 'Проверка отправки', $content);

            return $mailer->sendMail(true);
        }
    }
}
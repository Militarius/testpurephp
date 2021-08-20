<?php

namespace app\services;

use app\models\GroupModel;
use app\models\UserGroupsModel;
use app\models\UserModel;

class UserGroupService
{
    private $group_maps;
    private $link_maps;
    private $user_maps;

    public function __construct($groups, $links, $users = null)
    {
        /** @var GroupModel $group */
        foreach ($groups as $group) {
            $this->group_maps[$group->attributes['id']] = $group->attributes['name'];
        }

        /** @var UserGroupsModel $link */
        foreach ($links as $link) {
            $this->link_maps[$link->attributes['user_id']][$link->attributes['group_id']] = $this->group_maps[$link->attributes['group_id']];
        }

        if($users) {

            $user_maps = [];
            /** @var UserModel $link */
            foreach ($users as $user) {
                $user_maps[$user->attributes['id']] = $user;
            }
            foreach ($links as $link) {
                $this->user_maps[$link->attributes['user_id']] = $user_maps[$link->attributes['user_id']]??null;
            }
        }
    }

    public function getGroupsMap()
    {
        return $this->group_maps;
    }

    public function getLinksMap()
    {
        return $this->link_maps;
    }

    public function getUsersMap()
    {
        return $this->user_maps;
    }
}
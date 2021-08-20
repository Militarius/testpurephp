<?php

use app\services\UserGroupService;

/** @var array $models */
/** @var UserGroupService $mapperService */

?>
<div class="col">
    <a href="/user/create" title="Создать" class="btn btn-outline-primary">
        <i class="bi bi-plus"></i>&nbsp;Создать пользователя
    </a>
</div>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ФИО</th>
              <th scope="col">Электронная почта</th>
              <th scope="col">Группы</th>
              <th scope="col">Действия</th>
            </tr>
          </thead>
          <tbody>
              <?php
                foreach ($models as $model) {
                    ?>
                        <tr>
                            <td>
                                <a href="/user/update/<?=$model->attributes['id']?>" title="Редактировать">
                                    <?= $model->attributes['lastname'] . ' ' . $model->attributes['firstname'] . ' ' . $model->attributes['middlename'] ?>
                                </a>
                            </td>
                            <td><?= $model->attributes['email'] ?></td>
                            <td><?= implode(', ', ($mapperService->getLinksMap()[$model->attributes['id']]??[])) ?></td>
                            <td>
                                <a href="/user/update/<?=$model->attributes['id']?>" title="Редактировать" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                &nbsp;
                                <a href="/user/delete/<?=$model->attributes['id']?>" title="Удалить" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                  <?php
                }
              ?>
          </tbody>
        </table>
      </div>
<?php
/** @var array $models */
?>
<div class="col">
    <a href="/user/create" title="Создать" class="btn btn-outline-primary">
        <i class="bi bi-plus"></i>&nbsp;Создать пользователя
    </a>
    &nbsp;
    <a href="/user/delete" title="Удалить выбранные" class="btn btn-outline-danger">
        <i class="bi bi-trash-fill"></i>&nbsp;Удалить выбранные
    </a>
</div>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Фамилия</th>
              <th scope="col">Имя</th>
              <th scope="col">Отчество</th>
              <th scope="col">Электронная почта</th>
            </tr>
          </thead>
          <tbody>
              <?php
                foreach ($models as $model) {
                    ?>
                        <tr>
                            <td>
                                <label for="userCheck<?= $model->attributes['id'] ?>"></label>
                                <input type="checkbox" class="form-check-input check-user" id="userCheck<?= $model->attributes['id'] ?>">
                            </td>
                            <td><?= $model->attributes['lastname'] ?></td>
                            <td><?= $model->attributes['firstname'] ?></td>
                            <td><?= $model->attributes['middlename'] ?></td>
                            <td><?= $model->attributes['email'] ?></td>
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
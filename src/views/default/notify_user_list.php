<?php

use app\models\UserModel;

/** @var array $models */

?>
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
        /** @var UserModel $model */
        foreach ($models as $model) {
            ?>
            <tr>
                <td>
                    <label for="userCheck<?= $model->attributes['id'] ?>"></label>
                    <input type="checkbox" class="form-check-input check-user" data-id="<?= $model->attributes['id'] ?>" id="userCheck<?= $model->attributes['id'] ?>">
                </td>
                <td><?= $model->attributes['lastname'] ?></td>
                <td><?= $model->attributes['firstname'] ?></td>
                <td><?= $model->attributes['middlename'] ?></td>
                <td><?= $model->attributes['email'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<?php

use app\models\UserModel;

/** @var UserModel $model */
?>
<form method="post" enctype="multipart/form-data" accept-charset="UTF-8">
    <div class="mb-3">
        <label for="nameField" class="form-label">Фамилия</label>
        <input type="text" class="form-control" id="nameField" name="lastname" value="<?=$model->attributes['lastname']?>">
    </div>
    <div class="mb-3">
        <label for="nameField" class="form-label">Имя</label>
        <input type="text" class="form-control" id="nameField" name="firstname" value="<?=$model->attributes['firstname']?>">
    </div>
    <div class="mb-3">
        <label for="nameField" class="form-label">Отчество</label>
        <input type="text" class="form-control" id="nameField" name="middlename" value="<?=$model->attributes['middlename']?>">
    </div>
    <div class="mb-3">
        <label for="descriptionField" class="form-label">Электронная почта</label>
        <input type="text" class="form-control" id="descriptionField" name="email" value="<?=$model->attributes['email']?>">
    </div>
    <button type="submit" class="btn btn-primary"><?=($model->attributes['id']!=='')?'Изменить':'Сохранить'?></button>
</form>

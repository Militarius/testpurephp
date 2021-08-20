<?php

use app\models\GroupModel;

/** @var GroupModel $model */
?>
<form method="post" enctype="multipart/form-data" accept-charset="UTF-8">
    <div class="mb-3">
        <label for="nameField" class="form-label">Наименование группы</label>
        <input type="text" class="form-control" id="nameField" name="name" value="<?=$model->attributes['name']?>">
    </div>
    <div class="mb-3">
        <label for="descriptionField" class="form-label">Описание группы</label>
        <input type="text" class="form-control" id="descriptionField" name="description" value="<?=$model->attributes['description']?>">
    </div>
    <button type="submit" class="btn btn-primary"><?=($model->attributes['id']!=='')?'Изменить':'Сохранить'?></button>
</form>

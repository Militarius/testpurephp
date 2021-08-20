<?php

use app\models\UserModel;
use app\services\UserGroupService;

/** @var UserModel $model */
/** @var UserGroupService $mapperService */
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
    <div class="mb-3">
        <label for="" class="form-label">Привязанные группы</label>
        <div class="border border-1 rounded-3 p-2">
            <?php
                if(($mapperService->getLinksMap() !== null) && !empty($map_links = $mapperService->getLinksMap()[$model->attributes['id']]??[])) {
                    echo implode(', ', $map_links);
                } else {
                    echo 'Отсутсвует привязки к группам';
                }
            ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="groupsField" class="form-label">Привязка групп</label>
        <select id="groupsField" class="form-control" name="Groups[]" multiple="multiple">
            <?php
                $groupsMapper = $mapperService->getGroupsMap();
                foreach ($groupsMapper as $id => $name) {
                    echo "<option value=\"$id\">$name</option>";
                }
                $json_groups = json_encode( array_keys($mapperService->getLinksMap()[$model->attributes['id']]??[]));
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><?=($model->attributes['id']!=='')?'Изменить':'Сохранить'?></button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#groupsField').val(<?=$json_groups?>).select2();
    });
</script>

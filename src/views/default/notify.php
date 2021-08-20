<?php

use app\models\UserModel;
use app\services\UserGroupService;

/** @var UserModel $model */
/** @var UserGroupService $mapperService */
?>
<form method="post" enctype="multipart/form-data" accept-charset="UTF-8">
    <div class="mb-3">
        <label for="groupsField" class="form-label">Выбор группы</label>
        <select id="groupsField" class="form-control" name="Groups">
            <option></option>
            <?php
            $groupsMapper = $mapperService->getGroupsMap();
            foreach ($groupsMapper as $id => $name) {
                echo "<option value=\"$id\">$name</option>";
            }

            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="contentField" class="form-label">Сообщение</label>
        <textarea type="text" class="form-control" id="contentField" name="contentField"></textarea>
    </div>
    <div class="mb-3" id="get-user-list"></div>

    <button type="button" class="btn btn-primary" id="notifySend">Отправить</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        let groupsField = $('#groupsField');
        let notifySend = $('#notifySend');

        groupsField.select2({
            placeholder: "Выберите группу",
            allowClear: true
        });

        groupsField.on('change', (e) => {
            $.ajax({
                method: 'post',
                url: '/notify_user_list',
                data: {
                    group: e.target.value
                },
                success: (e) => {
                    $('#get-user-list').html(e);
                }
            })
        });

        notifySend.on('click', (e) => {
            e.preventDefault();

            let content = $('#contentField').val();
            let checkeds = $('.check-user').filter(':checked');
            let ids = [];

            console.log(content);

            for(let check_user of checkeds) {
                ids.push(check_user.dataset.id);
            }


            $.ajax({
                method: 'post',
                url: '/notify_send',
                data: {
                    users: ids,
                    content: content
                }
            })
        });
    });
</script>

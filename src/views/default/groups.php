<?php
/** @var array $models */
?>
<div class="col">
    <a href="/group/create" title="Создать" class="btn btn-outline-primary">
        <i class="bi bi-plus"></i>&nbsp;Создать группу
    </a>
    &nbsp;
    <a href="/group/delete" title="Удалить выбранные" id="deleteGroups" class="btn btn-outline-danger">
        <i class="bi bi-trash-fill"></i>&nbsp;Удалить выбранные
    </a>
</div>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Наименование</th>
              <th scope="col">Описание</th>
              <th scope="col">Действия</th>
            </tr>
          </thead>
          <tbody>
              <?php
                foreach ($models as $model) {
                    ?>
                        <tr>
                            <td>
                                <label for="groupCheck<?= $model->attributes['id'] ?>"></label>
                                <input type="checkbox" class="form-check-input check-group" data-id="<?= $model->attributes['id'] ?>" id="groupCheck<?= $model->attributes['id'] ?>">
                            </td>
                            <td><?= $model->attributes['name'] ?></td>
                            <td><?= $model->attributes['description'] ?></td>
                            <td>
                                <a href="/group/update/<?=$model->attributes['id']?>" title="Редактировать" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                &nbsp;
                                <a href="/group/delete/<?=$model->attributes['id']?>" title="Удалить" class="btn btn-sm btn-outline-danger">
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

<script type="text/javascript">
    $(document).ready(function() {
        let deleteGroups = $('#deleteGroups');

        deleteGroups.on('click', (e) => {
            e.preventDefault();

            let checkeds = $('.check-group').filter(':checked');
            var ids = [];

            for(let group of checkeds) {
                ids.push(group.dataset.id);
            }
            $.ajax({
                method: 'post',
                url: '/group/delete',
                data: {
                    ids: ids
                },
                success: (e) => {
                    document.location.reload();
                }
            })
        });
    });
</script>
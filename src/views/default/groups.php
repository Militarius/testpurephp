<?php
/** @var array $models */
?>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Наименование</th>
              <th scope="col">Описание</th>
            </tr>
          </thead>
          <tbody>
              <?php
                foreach ($models as $model) {
                    ?>
                        <tr>
                            <td><?php echo $model->attributes['id']; ?></td>
                            <td><?php echo $model->attributes['name']; ?></td>
                            <td><?php echo $model->attributes['description']; ?></td>
                            <td></td>
                        </tr>
                  <?php
                }
              ?>
          </tbody>
        </table>
      </div>
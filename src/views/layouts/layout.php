<?php

use app\controllers\DefaultController;

/** @var DefaultController $this */
/** @var string $page */
/** @var array $params */

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title><?php echo $this->title ?></title>
</head>
<body class="d-flex flex-column justify-content-between px-5">
<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/groups" class="nav-link">Группы пользователей</a></li>
            <li class="nav-item"><a href="/users" class="nav-link">Пользователи</a></li>
            <li class="nav-item"><a href="/send_notify" class="nav-link">Отправка уведомлений</a></li>
        </ul>
    </header>
</div>
<div class="body-content my-auto flex-grow-1 h-100">
    <?php echo $this->getContent($page, $params) ?>
</div>

<div id="ajax-container"></div>

<div class="container">
    <footer class="py-3 my-4">
        <p class="text-center text-muted">© 2021 Company, Inc</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(() => {
        $.ajax({
            url: '/test',
            success: (e) => {
                $('#ajax-container').html(e);
            }
        });
    });
</script>

</body>
</html>


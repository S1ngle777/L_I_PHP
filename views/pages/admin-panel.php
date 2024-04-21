<?php

/**
 * Файл представления для административной панели.
 *
 * Этот файл содержит HTML-разметку и PHP-код для отображения административной панели.
 * Он включает несколько частей страницы, таких как заголовок, формы административной панели и подвал.
 *
 * @package views/pages
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

    <?php
    require './handlers/page.php';
    Page::part('header-admin-panel');
    Page::part('admin-panel-forms');
    Page::part('footer');
    ?>
</body>

</html>
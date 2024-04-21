<?php

/**
 * Файл представления для страницы авторизации.
 *
 * Этот файл содержит HTML-разметку и PHP-код для отображения страницы авторизации.
 * Он подключает необходимые файлы и выводит форму авторизации.
 *
 * @package views/pages
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <?php
    require './handlers/page.php';

    Page::part('autorisation-form');
    ?>


</body>

</html>
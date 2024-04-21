<?php

/**
 * Файл представления для страницы регистрации.
 *
 * Этот файл содержит HTML-разметку и PHP-код для отображения страницы регистрации.
 * Он подключает файл-обработчик 'page.php' и выводит форму регистрации с помощью метода 'part' класса 'Page'.
 *
 * @package views/pages
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <?php
    require './handlers/page.php';

    Page::part('registration-form');
    ?>
</body>

</html>
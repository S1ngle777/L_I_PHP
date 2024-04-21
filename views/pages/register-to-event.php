<?php

/**
 * Файл register-to-event.php отображает страницу регистрации на событие.
 * 
 * Этот файл содержит HTML-разметку и PHP-код для отображения страницы регистрации на событие.
 * Он подключает необходимые файлы и вызывает соответствующие методы класса Page для отображения заголовка, формы регистрации и подвала.
 * 
 * @package views/pages
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись</title>

    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <?php
    require './handlers/page.php';
    Page::part('header');
    Page::part('register-to-event-form');
    Page::part('footer');
    ?>

</body>

</html>
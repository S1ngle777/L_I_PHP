<?php

/**
 * Файл представления для страницы "Мероприятия".
 *
 * Этот файл содержит HTML-разметку и PHP-код для отображения страницы "Мероприятия".
 * Он подключает необходимые файлы и вызывает соответствующие методы класса Page для отображения общего шаблона страницы.
 *
 * @package views/pages
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мероприятияt</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <?php
    require './handlers/page.php';
    Page::part('header');
    Page::handler('events-handler');
    Page::part('footer');
    ?>
</body>

</html>
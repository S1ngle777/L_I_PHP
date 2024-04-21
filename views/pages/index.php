<?php

/**
 * Файл index.php представляет собой главную страницу веб-приложения "Мой город".
 * Он содержит HTML-разметку и PHP-код для отображения заголовка, стилей, шапки, описания и подвала страницы.
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой город</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
    <?php
    require './handlers/page.php';
    Page::part('header');
    Page::part('about');
    Page::part('footer');
    ?>

</body>

</html>
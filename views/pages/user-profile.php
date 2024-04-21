<?php

/**
 * Файл представления для страницы профиля пользователя.
 *
 * Этот файл содержит HTML-разметку для отображения страницы профиля пользователя.
 * Он включает в себя заголовок, стили, шапку, формы профиля пользователя и подвал.
 *
 * @package views/pages
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

    <?php
    require './handlers/page.php';
    Page::part('header');
    Page::part('user-profile-forms');
    Page::part('footer');
    ?>
</body>

</html>
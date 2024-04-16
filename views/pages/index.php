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
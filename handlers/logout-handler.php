<?php
// Получение токена из cookies
$token = $_COOKIE['token'];

// Подключение к базе данных
$db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');

// Удаление токена из базы данных
$query = $db->prepare('UPDATE users SET token = NULL WHERE token = ?');
$query->execute([$token]);

// Удаление cookie
setcookie('token', '', time() - 3600);

// Перенаправление пользователя на главную страницу
header("Location: /views/pages/index.php");

exit;
<?php
// Получение токена из cookies
$token = $_COOKIE['token'];

require __DIR__ . '/db-connection.php';

// Удаление токена из базы данных
$query = $db->prepare('UPDATE users SET token = NULL WHERE token = ?');
$query->execute([$token]);

// Удаление cookie
setcookie('token', '', time() - 3600);

// Перенаправление пользователя на главную страницу
header("Location: /views/pages/index.php");

exit;
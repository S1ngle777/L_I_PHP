<?php

// Подключение к базе данных
$db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');

// Получение токена из cookies
$token = $_COOKIE['token'];

// Получение пользователя по токену
$query = $db->prepare('SELECT * FROM users WHERE token = ?');
$query->execute([$token]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Перенаправление на страницу авторизации
    header("Location: /views/pages//autorisation.php");
}
else {

// Вывод приветствия пользователю
echo "<h3>Welcome, {$user['name']}!</h1>";
echo "<hr>";


// Получение текущих мероприятий
$query = $db->query('SELECT * FROM events');
$events = $query->fetchAll(PDO::FETCH_ASSOC);

// Вывод мероприятий
foreach ($events as $event) {
    echo "<h2>{$event['name']}</h2>";
    echo "<p>Price: {$event['price']}</p>";
    echo "<p>Seats: {$event['number_seats']}</p>";
    echo "<p>Date: {$event['date']}</p>";
    echo "<hr>";
}
}
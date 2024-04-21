<?php

require __DIR__ . '/db-connection.php';

// Получение токена из cookies
$token = $_COOKIE['token'];

// Получение пользователя по токену
$query = $db->prepare('SELECT * FROM users WHERE token = ?');
$query->execute([$token]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Перенаправление на страницу авторизации
    header("Location: /views/pages/autorisation.php");
} else {

    // Вывод приветствия пользователю
    echo "<h3>Welcome, {$user['name']}!</h1>";
    echo "<hr>";


    // Получение текущих мероприятий
    $query = $db->query('SELECT * FROM events');
    $events = $query->fetchAll(PDO::FETCH_ASSOC);

    // Вывод мероприятий
    foreach ($events as $event) {
        // Получение количества занятых мест
        $query = $db->prepare('SELECT COUNT(*) FROM event_records WHERE event_id = ?');
        $query->execute([$event['id']]);
        $bookedSeats = $query->fetchColumn();

        if ($event['price'] == 0) {
            $event['price'] = 'Бесплатный вход';
        }

        // Вычисление количества свободных мест
        $freeSeats = $event['number_seats'] - $bookedSeats;
        echo "<div class='events'> <div>";
        echo "<img src='/assets/images/{$event['image']}'>";
        echo "</div> <div>";
        echo "<h2>{$event['name']}</h2>";
        echo "<p>Стоимость: {$event['price']}</p>";
        echo "<p>Общее колличество мест: {$event['number_seats']}</p>";
        echo "<p>Осталось мест: {$freeSeats}</p>";
        echo "<p>Дата: {$event['date']}</p>";
        echo "</div> </div>";
        echo "<hr>";
    }
}

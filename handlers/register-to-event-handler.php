<?php
require __DIR__ . '/db-connection.php';



// Получение токена пользователя из куки
$token = $_COOKIE['token'];

// Получение ID пользователя по токену
$query = $db->prepare('SELECT id FROM users WHERE token = ?');
$query->execute([$token]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Если пользователь найден
if ($user) {
    // Получение ID мероприятия из формы
    $eventId = $_POST['event_id'];

    // Проверка не зарегистрирован ли пользователь на мероприятие
    $query = $db->prepare('SELECT * FROM event_records WHERE user_id = ? AND event_id = ?');
    $query->execute([$user['id'], $_POST['event_id']]);
    $record = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($record) {
        // alert "Вы уже зарегистрированы на это мероприятие!"
        echo "<script>alert('Вы уже зарегистрированы на это мероприятие!');</script>";
        // Перенаправление на страницу мероприятий
        header("refresh:1;url=/views/pages/events.php");
        exit;
    }

    // Проверка что есть места
    $query = $db->prepare('SELECT COUNT(*) FROM event_records WHERE event_id = ?');
    $query->execute([$eventId]);
    $bookedSeats = $query->fetchColumn();

    $query = $db->prepare('SELECT number_seats FROM events WHERE id = ?');
    $query->execute([$eventId]);
    $numberSeats = $query->fetchColumn();

    if ($bookedSeats >= $numberSeats) {
        // alert "На мероприятии закончились места!"
        echo "<script>alert('На мероприятии закончились места!');</script>";
        // Перенаправление на страницу мероприятий
        header("refresh:1;url=/views/pages/events.php");
        exit;
    }
    
    // Регистрация пользователя на мероприятие
    $query = $db->prepare('INSERT INTO event_records (user_id, event_id) VALUES (?, ?)');
    $query->execute([$user['id'], $eventId]);


    // alert "Вы успешно зарегистрировались на мероприятие!"
    echo "<script>alert('Вы успешно зарегистрировались на мероприятие!');</script>";

    // Перенаправление на страницу мероприятий

    header("refresh:1;url=/views/pages/events.php");
} else {
    echo "Ошибка: пользователь не найден";
}

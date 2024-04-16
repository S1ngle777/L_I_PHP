<?php
// Подключение к базе данных
$db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');

// Получение токена пользователя из сессии или куки
$token = $_SESSION['token'] ?? $_COOKIE['token'];

// Получение ID пользователя по токену
$query = $db->prepare('SELECT id FROM users WHERE token = ?');
$query->execute([$token]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Если пользователь найден
if ($user) {
    // Получение ID мероприятия из формы
    $eventId = $_POST['event_id'];

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

<?php
// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Подключение к базе данных
    $db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');

    // Получение пользователя
    $query = $db->prepare('SELECT * FROM users WHERE email = ?');
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Проверка пароля
    if ($user && password_verify($password, $user['password'])) {
        // Создание нового токена
        $token = bin2hex(random_bytes(64));

        // Сохранение нового токена в базе данных
        $query = $db->prepare('UPDATE users SET token = ? WHERE email = ?');
        $query->execute([$token, $email]);

        // Сохранение токена в cookies
        setcookie('token', $token, time() + (86400 * 30), "/"); // 86400 = 1 day

        // Перенаправление на страницу мероприятий
        header("Location: /views/pages/events.php");
    } else {
        die('Неверные учетные данные');
    }
}
?>
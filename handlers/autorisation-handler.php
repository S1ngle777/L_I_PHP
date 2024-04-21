<?php
// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require __DIR__ . '/db-connection.php';

    // Получение пользователя
    $query = $db->prepare('SELECT * FROM users WHERE email = ?');
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[3] = "Неверный формат email";
        echo "<script>alert('$errors[3]');</script>";
        header("refresh:1;url=/views/pages/autorisation.php");
    } else {



        // Проверка пароля
        if ($user && password_verify($password, $user['password'])) {
            // Создание нового токена
            $token = bin2hex(random_bytes(64));

            // Сохранение нового токена в базе данных
            $query = $db->prepare('UPDATE users SET token = ? WHERE email = ?');
            $query->execute([$token, $email]);

            // Сохранение токена в cookies
            setcookie('token', $token, time() + (86400), "/"); // 86400 = 1 day

            // Перенаправление на страницу мероприятий
            header("Location: /views/pages/events.php");
        } else {
            // Вывод сообщения об ошибке
            $message = "Неверный email или пароль";
            echo "<script>alert('$message');</script>";

            // Перенаправление на страницу авторизации
            header("refresh:1;url=/views/pages/autorisation.php");
        }
    }
}

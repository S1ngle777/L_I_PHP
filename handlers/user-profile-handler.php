<?php

require __DIR__ . '/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $action = $_POST['action'];

    // Получение пользователя по токену
    $query = $db->prepare('SELECT * FROM users WHERE token = ?');
    $query->execute([$_COOKIE['token']]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($action === 'change-pass') {
        // Получение данных из формы
        $oldPassword = $_POST['old-password'];
        $password = $_POST['password'];

        // Валидация данных
        $errors = [];
        if (strlen($password) < 2 || strlen($password) > 20) {
            $errors[4] = "Пароль должен содержать не менее 2 и не более 20 символов";
            echo "<script>alert('$errors[4]');</script>";
            header("refresh:1;url=/views/pages/user-profile.php");
        } else {
            // Проверка, совпадает ли старый пароль
            if (password_verify($oldPassword, $user['password'])) {
                // Обновление пароля
                $query = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
                $query->execute([password_hash($password, PASSWORD_DEFAULT), $user['id']]);

                echo "<script>alert('Пароль успешно изменен!');</script>";

                // Перенаправление на страницу личного кабинета
                header("refresh:1;url=/views/pages/user-profile.php");
            } else {
                // Не совпадает старый пароль
                echo "<script>alert('Старый пароль не совпадает!');</script>";
                header("refresh:1;url=/views/pages/user-profile.php");
            }
        }
    } elseif ($action === 'change-email') {
        // Получение данных из формы
        $oldEmail = $_POST['old-email'];
        $email = $_POST['email'];

        // Валидация данных
        $errors = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[3] = "Неверный формат email";
            echo "<script>alert('$errors[3]');</script>";
            header("refresh:1;url=/views/pages/user-profile.php");
        } else {

            // Проверка, совпадает ли старая почта
            if ($oldEmail === $user['email']) {
                // Обновление почты
                $query = $db->prepare('UPDATE users SET email = ? WHERE id = ?');
                $query->execute([$email, $user['id']]);

                echo "<script>alert('Почта успешно изменена!');</script>";

                // Перенаправление на страницу личного кабинета
                header("refresh:1;url=/views/pages/user-profile.php");
            } else {
                // Не совпадает старая почта
                echo "<script>alert('Старая почта не совпадает!');</script>";

                header("refresh:1;url=/views/pages/user-profile.php");
            }
        }
    }
}

<?php
// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Подключение к базе данных
    $db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');

    // Добавление пользователя
    $query = $db->prepare('INSERT INTO users (name, surname, email, role_id, password) VALUES (?, ?, ?, ?, ?)');
    $query->execute([$name, $surname, $email, 2, password_hash($password, PASSWORD_DEFAULT)]);

    // Вывод сообщения об успешной регистрации 
    $message = "Вы успешно зарегистрировались!";
    echo "<script>alert('$message');</script>";

    // Перенаправление на страницу авторизации
    header("refresh:1;url=/views/pages/autorisation.php");
} else {
    // Вывод динамического сообщения о неверных данных
    $message = "Неверные данные!";
    echo "<script>alert('$message');</script>";
    header("Location: /views/pages/registration.php");
}

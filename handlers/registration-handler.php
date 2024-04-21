<?php

// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    require __DIR__ . '/db-connection.php';

    // Валидация данных
    $erros = [];
    // Проверка 
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[1] = "Имя может содержать только буквы и пробелы";
        echo "<script>alert('$errors[1]');</script>";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
        $errors[2] = "Фамилия может содержать только буквы и пробелы";
        echo "<script>alert('$errors[2]');</script>";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[3] = "Неверный формат email";
        echo "<script>alert('$errors[3]');</script>";
    }

    // if (strlen($password) < 8){
    //     $errors[4] = "Пароль должен содержать не менее 8 символов";
    //     echo "<script>alert('$errors[4]');</script>";
    // }
    if (strlen($password) < 2 || strlen($password) > 20){
        $errors[4] = "Пароль должен содержать не менее 2 и не более 20 символов";
        echo "<script>alert('$errors[4]');</script>";
    }

    // Проверка на существование пользователя с таким email
    $query = $db->prepare('SELECT * FROM users WHERE email = ?');
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user) {
        $errors[5] = "Пользователь с таким email уже существует";
        echo "<script>alert('$errors[5]');</script>";
    }

    if (count($errors) > 0) {
        header("refresh:1;url=/views/pages/registration.php");
    } else {
        // Добавление пользователя
        $query = $db->prepare('INSERT INTO users (name, surname, email, role_id, password) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$name, $surname, $email, 2, password_hash($password, PASSWORD_DEFAULT)]);

        // Вывод сообщения об успешной регистрации 
        $message = "Вы успешно зарегистрировались!";
        echo "<script>alert('$message');</script>";

        // Перенаправление на страницу авторизации
        header("refresh:1;url=/views/pages/autorisation.php");
    }
}

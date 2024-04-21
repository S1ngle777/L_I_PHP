<?php
require __DIR__ . '/db-connection.php';

// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $action = $_POST['action'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $number_seats = $_POST['number_seats'];
    $date = $_POST['date'];

    if ($action === 'add') {
        // Добавление нового мероприятия
        $image = $_FILES['image']['name'];
        // Загрузка файла на сервер

        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../assets/images/' . $image);
        // Обновление SQL запросов
        $query = $db->prepare('INSERT INTO events (name, price, number_seats, date, image) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$name, $price, $number_seats, $date, $image]);
    } elseif ($action === 'delete') {
        // Удаление мероприятия
        $id = $_POST['id'];
        $query = $db->prepare('DELETE FROM events WHERE id = ?');
        $query->execute([$id]);
    } elseif ($action === 'edit') {
        // Редактирование существующего мероприятия
        $image = $_FILES['image']['name'];
        // Загрузка файла на сервер
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../assets/images/' . $image);
        // Обновление SQL запросов
        $query = $db->prepare('UPDATE events SET name = ?, price = ?, number_seats = ?, date = ?, image = ? WHERE id = ?');
        $query->execute([$name, $price, $number_seats, $date, $image, $_POST['id']]);
    } elseif ($action === 'create_user') {
        // Создание нового пользователя
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        if ($role === 'admin') {
            $role_id = 1;
        } else {
            $role_id = 2;
        }

        $query = $db->prepare('INSERT INTO users (name, surname, email, role_id, password) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$name, $surname, $email, $role_id, $password]);
    }

    // Перенаправление обратно на страницу администратора
    header("Location: /views/pages/admin-panel.php");
    exit;
}

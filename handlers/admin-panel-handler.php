<?php
// Подключение к базе данных
$db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');

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
        $query = $db->prepare('INSERT INTO events (name, price, number_seats, date) VALUES (?, ?, ?, ?)');
        $query->execute([$name, $price, $number_seats, $date]);
    } elseif ($action === 'edit') {
        // Редактирование существующего мероприятия
        $id = $_POST['id'];
        $query = $db->prepare('UPDATE events SET name = ?, price = ?, number_seats = ?, date = ? WHERE id = ?');
        $query->execute([$name, $price, $number_seats, $date, $id]);
    }

    // Перенаправление обратно на страницу администратора
    header("Location: /views/pages/admin-panel.php");
    exit;
}
?>
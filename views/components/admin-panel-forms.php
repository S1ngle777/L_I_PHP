<?php
// Подключение к базе данных
$db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');

// Проверка, авторизован ли пользователь
if (!isset($_COOKIE['token'])) {
    // Перенаправление на страницу авторизации
    header("Location: /autorisation.php");
    exit;
}

// Получение пользователя по токену
$query = $db->prepare('SELECT * FROM users WHERE token = ?');
$query->execute([$_COOKIE['token']]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Проверка, является ли пользователь менеджером
if (!$user || $user['role_id'] != '1') {
    // Перенаправление на страницу авторизации
    header("Location: /autorisation.php");
    exit;
}
?>

<div class="back">
    <div class="form form2">
        <!-- Выбор действия -->
        <form id="action-form">
            <h3 style="text-align: center; margin: 10px">Управление мероприятиями</h3>
            <select id="action-select">
                <option value="add">Добавить мероприятие</option>
                <option value="edit">Редактировать мероприятие</option>
            </select>
        </form>

        <!-- Форма добавления мероприятия -->
        <form action="/handlers/admin-panel-handler.php" method="post" id="add-form" style="display: none;">
            <h2>Добавление мероприятия</h2>
            <input type="hidden" name="action" value="add">
            <label for="name">Название мероприятия:</label>
            <input type="text" id="name" name="name" autocomplete="off">
            <label for="price">Цена:</label>
            <input type="number" id="price" name="price" autocomplete="off">
            <label for="number_seats">Количество мест:</label>
            <input type="number" id="number_seats" name="number_seats" autocomplete="off">
            <label for="date">Дата:</label>
            <input type="datetime-local" id="date" name="date">
            <input type="submit" value="Сохранить">
        </form>

        <!-- Форма редактирования мероприятия -->
        <form action="/handlers/admin-panel-handler.php" method="post" id="edit-form" style="display: none;">
            <h2>Редактирование мероприятия</h2>
            <input type="hidden" name="action" value="edit">
            <label for="event-select">Выберите мероприятие:</label>
            <select id="event-select" name="id">
                <?php
                // Получение текущих мероприятий
                $query = $db->query('SELECT * FROM events');
                $events = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($events as $event) {
                    echo "<option value=\"{$event['id']}\">{$event['name']}</option>";
                }

                ?>
            </select>
            <label for="name">Название мероприятия:</label>
            <input type="text" id="name" name="name" autocomplete="off">
            <label for="price">Цена:</label>
            <input type="number" id="price" name="price" autocomplete="off">
            <label for="number_seats">Количество мест:</label>
            <input type="number" id="number_seats" name="number_seats" autocomplete="off">
            <label for="date">Дата:</label>
            <input type="datetime-local" id="date" name="date">
            <input type="submit" value="Сохранить">
        </form>
    </div>

    <!-- Просмотр зарегистрированных на мероприятие. -->

    <div class="form form2 form3">
        <div>
            <form method="POST">
                <h3 style="text-align: center; margin: 10px">Просмотр зарегистрированных пользователей</h3>
                <label for="event">Выберите мероприятие:</label>
                <select name="event_id" id="event">
                    <?php
                    // Получение всех мероприятий
                    $query = $db->prepare('SELECT * FROM events');
                    $query->execute();
                    $events = $query->fetchAll(PDO::FETCH_ASSOC);

                    // Вывод каждого мероприятия в качестве опции select
                    foreach ($events as $event) {
                        echo "<option value=\"{$event['id']}\">{$event['name']}</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Показать зарегистрированных пользователей">
            </form>
        </div>
        <div>
            <?php
            // Если форма была отправлена
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Получение id выбранного мероприятия
                $eventId = $_POST['event_id'];

                // Получение записей о регистрации на мероприятие
                $query = $db->prepare('SELECT * FROM event_records WHERE event_id = ?');
                $query->execute([$eventId]);
                $records = $query->fetchAll(PDO::FETCH_ASSOC);

                // Вывод информации о зарегистрированных пользователях
                echo "<h4>Зарегистрированные пользователи:</h4>";
                echo "<ul>";
                foreach ($records as $record) {
                    // Получение информации о пользователе
                    $query = $db->prepare('SELECT * FROM users WHERE id = ?');
                    $query->execute([$record['user_id']]);
                    $user = $query->fetch(PDO::FETCH_ASSOC);

                    // Вывод информации о пользователе
                    echo "<li>{$user['name']} {$user['surname']} ({$user['email']})</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>




</div>

<script>
    document.getElementById('action-select').addEventListener('change', function() {
        document.getElementById('add-form').style.display = this.value === 'add' ? 'block' : 'none';
        document.getElementById('edit-form').style.display = this.value === 'edit' ? 'block' : 'none';
    });
</script>
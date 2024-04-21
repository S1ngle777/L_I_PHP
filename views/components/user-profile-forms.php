<?php

require __DIR__ . '/../../handlers/db-connection.php';


// Получение пользователя по токену
/* Этот блок кода запрашивает базу данных для получения информации о пользователе на основе токена,
хранящегося в файле cookie пользователя. Вот разбивка того, что делает каждая строка: 
1. Подготовьте запрос к базе данных, чтобы получить все данные о пользователе, у которого токен равен значению cookie.
2. Выполните запрос.
3. Получите данные о пользователе в виде ассоциативного массива. 
    Этот массив будет содержать все данные о пользователе, включая его идентификатор, имя, фамилию, электронную почту, роль и токен. 
    Если пользователь не найден, переменная $user будет содержать значение null. 
    В противном случае она будет содержать данные о пользователе. 
    После этого блока кода проверяется, является ли пользователь авторизованным.

*/



$query = $db->prepare('SELECT * FROM users WHERE token = ?');
$query->execute([$_COOKIE['token']]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Проверка, является ли пользователь авторизованным
if (!$user) {

    // Перенаправление на страницу авторизации
    header("Location: /views/pages/autorisation.php");
    exit;
}

?>

<div class="back">
    <div class="form form2">
        <!-- Выбор действия -->
        <form id="action-form2">
            <h3 style="text-align: center; margin: 10px">Смена учетных данных</h3>
            <select id="action-select2">
                <option value="change-pass">Смена пароля</option>
                <option value="change-email">Смена email</option>
            </select>
        </form>

        <!-- Форма изменения пароля -->

        <form action="/handlers/user-profile-handler.php" id="change-pass" method="post" style="display: none;">
            <input type="hidden" name="action" value="change-pass">
            <label for="old-password">Старый пароль:</label>
            <input type="password" id="old-password" name="old-password">

            <label for="password">Новый пароль:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Изменить пароль">
        </form>

        <!-- Форма изменения почты -->
        <form action="/handlers/user-profile-handler.php" id="change-email" method="post" style="display: none;">
            <input type="hidden" name="action" value="change-email">
            <label for="email">Старая почта:</label>
            <input type="email" id="old-email" name="old-email">

            <label for="email">Новая почта:</label>
            <input type="email" id="email" name="email">
            <input type="submit" value="Изменить почту">
        </form>
    </div>
    <div class="form">
        <div>
            <?php
            // Вывод мероприятий на которые подписан пользователь
            $query = $db->prepare('SELECT * FROM event_records WHERE user_id = ?');
            $query->execute([$user['id']]);
            $records = $query->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($records);

            echo '<h3>Ваши записи на мероприятия</h3>';
            foreach ($records as $record) {
                echo '<hr>';
                $query = $db->prepare('SELECT * FROM events WHERE id = ?');
                $query->execute([$record['event_id']]);
                $event = $query->fetch(PDO::FETCH_ASSOC);
                // image
                echo '<img src="/assets/images/' . $event['image'] . '" alt="event-image" style="width: 100px; height: 100px;">';
                echo '<h3>' . $event['name'] . '</h3>';
                echo '<p>' . $event['date'] . '</p>';
                echo '<p>' . $event['price'] . ' лей</p>';
            }
            ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('action-select2').addEventListener('change', function() {
        document.getElementById('change-pass').style.display = this.value === 'change-pass' ? 'block' : 'none';
        document.getElementById('change-email').style.display = this.value === 'change-email' ? 'block' : 'none';
    });
</script>
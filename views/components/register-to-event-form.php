<div class="back">
    <div class="form form2">
        <form method="POST" action="/handlers/register-to-event-handler.php">
            <h1 style="text-align: center;">Регистрация на мероприятие</h1>
            <label for="event_id">Название мероприятия:</label>
            <select name="event_id" id="event_id">
                <?php
                require __DIR__ . '/../../handlers/db-connection.php';

                // Проверка, авторизован ли пользователь
                if (!isset($_COOKIE['token'])) {
                    // Перенаправление на страницу авторизации
                    header("Location: /views/pages/autorisation.php");
                    exit;
                }


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

            <input type="submit" value="Зарегистрироваться на мероприятие">
        </form>
    </div>
</div>
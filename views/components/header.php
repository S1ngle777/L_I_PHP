<header>

    <div class="blocks" style="margin: 10px; font-size: 30px;">
        #Мой-Город
    </div>
    <div class="blocks">
        <a href="/views/pages/events.php">Мероприятия</a>
    </div>
    <div class="blocks">
        <a href="/views/pages/register-to-event.php">Записаться</a>
    </div>

    <div>
        <?php
        // Подключение к базе данных
        $db = new PDO('mysql:host=localhost;dbname=event_platform', 'root', '123qweasd');
        // Получение пользователя по токену
        $query = $db->prepare('SELECT * FROM users WHERE token = ?');
        $query->execute([$_COOKIE['token']]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) : ?>
            <div class="blocks">
                <a href="/handlers/logout-handler.php">Выйти</a>
            </div>
            <?php if ($user['role_id'] == '1') : ?>
                <div class="blocks">
                    <a href="admin-panel.php">Админ-панель</a>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="blocks">
                <a href="/views/pages/autorisation.php">Войти</a>
            </div>
            <div class="blocks">
                <a href="/views/pages/registration.php">Регистрация</a>
            </div>
        <?php endif; ?>
    </div>

</header>
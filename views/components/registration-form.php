<div class="back">
    <div class="form">
        <form action="\handlers\registration-handler.php" method="POST">
            <h1 style="text-align: center;">Регистрация</h1>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required autocomplete="off"><br>
            <span><?php if (isset($errors[1])) {echo $errors[1]. '<br>';} ?></span>

            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required autocomplete="off"><br>
            <span><?php if (isset($errors[2])) {echo $errors[2] . '<br>';} ?></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required autocomplete="off"><br>
            <span><?php if (isset($errors[3])) {echo $errors[3] . '<br>';} ?></span>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="off"><br>
            <span><?php if (isset($errors[4])) {echo $errors[4] . '<br>';} ?></span>

            <input type="submit" value="Register">
        </form>
    </div>
</div>

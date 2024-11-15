<?php

require_once __DIR__ . '/src/helpers.php';
checkGuest();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/pico.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <form class="reg" action="src/actions/register.php" method="post" enctype="multipart/form-data">
        <h1>Регистрация</h1>
        <label for="name">Имя
            <input name="name" id="name"
                   placeholder="Иван Иванов"
                   value="<?php echo getOldValue('name')?>"
                   <?php mayBeHasError('name'); ?> >
            <small><?php getErrorMessage('name');?></small>

        </label>
        <label for="email">E-mail
            <input name="email"
                   id="email"
                   type="email"
                   placeholder="ivan.ivanov@gmail.com"
                   value="<?php echo getOldValue('email')?>"
                   <?php mayBeHasError('email'); ?> >
            <small><?php getErrorMessage('email');?></small>
        </label>

        <label for="avatar">Изображение профиля
            <input name="avatar"
                   id="avatar"
                   type="file"
                   accept="image/*"
                   <?php mayBeHasError('avatar'); ?> >
            <small><?php getErrorMessage('avatar');?></small>
        </label>

        <div class="password">
            <div>
                <label>Пароль</label>
                <input name="password" id="password"  type="password" placeholder="********"  <?php mayBeHasError('password'); ?> >
                <small><?php getErrorMessage('password');?></small>
            </div>
            <div>
                <label>Подтверждение</label>
                <input name="password_confirmation" id="password_confirmation"  type="password" placeholder="********" <?php mayBeHasError('password'); ?> >
            </div>

        </div>
        <div class="check">
            <label for="terms">
                <input name="terms" id="terms" type="checkbox"  <?php mayBeHasError('terms'); ?> >
                Я принимаю все условия пользования
                <br>
                <small><?php getErrorMessage('terms');?></small>

            </label>


        </div>

        <button>Продолжить</button>
    </form>

    <?php clearValidation() ?>

    <div class="snoska">
        <p>
            У меня есть <a href="index.php">аккаунт</a>
        </p>
    </div>

</body>
</html>
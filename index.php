<?php
require_once __DIR__ . '/src/helpers.php';
checkGuest();

?>

<!DOCTYPEhtml>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/pico.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <form class="osnova" action="src/actions/login.php" method="post" enctype="multipart/form-data">
        <h1>Вход</h1>

        <?php if(hasMessage('error')): ?>
        <div class="error-message">
            <span class="error-text"><?php echo getMessage('error')?>.</span>
        </div>
        <?php endif; ?>


        <label for="email">E-mail
            <input name="email"
                   id="email"
                   type="email"
                   placeholder="ivan.ivanov@gmail.com"
                   <?php mayBeHasError('email'); ?> >
            <small><?php getErrorMessage('email');?></small>
        </label>
        <label>Пароль
            <input name="password"
                   id="password"
                   type="password"
                   placeholder="********">
        </label>
        <button>Продолжить</button>
    </form>
    <?php clearValidation() ?>
    <div class="snoska">
        <p>
            У меня нет <a href="register.php">аккаунта</a>
        </p>
    </div>
</body>
</html>
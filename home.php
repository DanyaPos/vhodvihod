<?php

require_once __DIR__ . '/src/helpers.php';

checkAuth();

$user = currentUser();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <form class="home" action="src/actions/logout.php" method="post">
        <img class="avatar" src="<?=$user['avatar'] ?>" alt="<?=$user['name'] ?>">
        <h2>Привет, <?=$user['name'] ?> </h2>
        <button class="homebutton">Выйти из аккаунта</button>
    </form>
</body>
</html>
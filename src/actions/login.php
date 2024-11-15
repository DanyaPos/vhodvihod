<?php

require_once __DIR__ . '/../helpers.php';

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($email)) {
    addValidationError('email', 'Укажите почту');
    redirect('../../index.php');
}


$user = findUser($email);

if (!$user){
    setMessage('error', "Пользователь не найден");
    redirect('../../index.php');
}


if (!password_verify($password, $user['password'])){
    setMessage('error', "Неверный пароль");
    redirect('../../index.php');
}

$_SESSION['user']['id'] = $user['id'];

redirect('../../home.php');

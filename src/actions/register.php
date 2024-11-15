<?php

require_once __DIR__ . '/../helpers.php';

// Выносим данные из post
$name = trim($_POST['name']) ?? null;
$email = trim($_POST['email']) ?? null;
$password = $_POST['password'] ?? null;
$passwordConfirmation = $_POST['password_confirmation'] ?? null;
$terms = $_POST['terms'] ?? null;
$avatar = $_FILES['avatar'] ?? null;

// Validation

$_SESSION['validation'] = [];


if (empty($name)){
    addValidationError('name', 'Неверное имя');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    addValidationError('email', 'Указана неправильная почта');
}

if (empty($password)){
    addValidationError('password', 'Неверный пароль');
}

if ($password != $passwordConfirmation){
    addValidationError('password', 'Пароли не совпадают');
}

if ($avatar == null || $avatar['error'] !== UPLOAD_ERR_OK) {
    addValidationError('avatar', 'Добавьте изображение');
} else {
    $allowedTypes = ['image/png', 'image/jpeg'];

    if (!in_array($avatar['type'], $allowedTypes)) {
        addValidationError('avatar', 'Неверный тип');
    }


    if ($avatar['size'] / 1000000 >= 3) {
        addValidationError('avatar', 'Изображение должно быть меньше 3 мб');
    }
}


if ($terms != true){
    addValidationError('terms', 'Обязательное условие');
}


if (!empty($_SESSION['validation'])) {
    addOldValue('name', $name);
    addOldValue('email', $email);
    redirect('../../register.php');
}

if (!empty($avatar)){
    $avatarPath = uploadFile($avatar);
}

$pdo = getPDO();

$query = "INSERT INTO users (name, email, avatar, password) VALUES (:name, :email, :avatar, :password)";
$params = [
    'name' => $name,
    'email' => $email,
    'avatar' => $avatarPath,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
$stmt = $pdo->prepare($query);

try {
    $stmt -> execute($params);
} catch (\Exception $e) {
    die($e->getMessage());
}

redirect('../../index.php');

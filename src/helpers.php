<?php
declare(strict_types=1);
require_once ('config.php');
session_start();


function redirect(string $path)
{
    header("Location: $path");
    die();
}

function mayBeHasError(string $field)
{
    echo isset($_SESSION['validation'][$field]) ? 'aria-invalid="true"' : '';
}

function getErrorMessage(string $field)
{
    echo $_SESSION['validation'][$field] ?? '';
}

function addValidationError(string $field, string $message)
{
    $_SESSION['validation'][$field] = $message;
}

function clearValidation(): void
{
    $_SESSION['validation'] = [];
}

function addOldValue(string $key, mixed $value)
{
    $_SESSION['old'][$key] = $value;
}

function getOldValue(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function uploadFile(array $files)
{
    if (!is_dir('../../uploads')){
        mkdir('../../uploads', 0777, true);
    }

    $extension = pathinfo($files['name'], PATHINFO_EXTENSION);

    $fileName = 'avatar_' . time() . '.' . $extension;

    if (!move_uploaded_file($files['tmp_name'], '../../uploads/' . $fileName)) {
        die('Ошибка при загрузке');
    };

    return "uploads/$fileName";
}

function getPDO():PDO
{
   try {
       return new \PDO('mysql:host=' . DB_HOST . ';port='. DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
   } catch (PDOException $e) {
       die($e->getMessage());
   }
}

function setMessage(string $key, string $message)
{
    $_SESSION['messages'][$key] = $message;
}

function getMessage(string $key)
{
    $message = $_SESSION['messages'][$key] ?? '';
    unset($_SESSION['messages'][$key]);
    return $message;
}

function hasMessage(string $key)
{
    return isset($_SESSION['messages'][$key]);
}

function findUser($email)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE `email` = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function currentUser()
{
    $pdo = getPDO();

    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function logout()
{
    unset($_SESSION['user']['id']);
    redirect('../../index.php');
}

function checkAuth()
{
    if (!isset($_SESSION['user']['id'])) {
        redirect('index.php');
    }
}

function checkGuest()
{
    if (isset($_SESSION['user']['id'])) {
        redirect('home.php');
    }
}
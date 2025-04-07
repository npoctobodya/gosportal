<?php
require_once(__DIR__ . "/../helpers.php");

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['validation']['email'] = 'Неверный email';
    $_SESSION['old']['email'] = $email;
    redirect("/../index.php");
}

$user = findUser($email);

if (!$user) {
    $_SESSION['validation']['email'] = "Пользователь не найден!";
    $_SESSION['old']['email'] = $email;
    redirect("/../index.php");
}

if (!password_verify($password, $user["password"])) {
    $_SESSION['validation']['password'] = "Неверный пароль";
    $_SESSION['old']['email'] = $email;
    redirect("/../index.php");
}

$_SESSION['user']['id'] = $user['user_id'];
redirect("/../main.php");

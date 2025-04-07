<?php
require_once(__DIR__ ."/../helpers.php");

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];
$_SESSION['validation'] = [];

cyrilicAndSpacesValidation($name, 'name', 'Имя должно');
cyrilicAndSpacesValidation($lastname, 'lastname', 'Фамилия должна');

if (!empty($surname)) {
    cyrilicAndSpacesValidation($surname, 'surname', 'Отчество должно');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['validation']['email'] = 'Неверный email';
}

if (!empty($phone) && !preg_match('~^(?:\+7|8)\d{10}$~', $phone)) {
    $_SESSION['validation']['phone'] = 'Неверный номер телефона';
} else {
    $phone = str_replace('+7', '8', $phone);
}

if ($password !== $repeatPassword) {
    $_SESSION['validation']['repeatPassword'] = 'Пароли не совпадают';
} else {
    unset($repeatPassword);
}

if (!empty($_SESSION['validation'])) {
    setOldValuesToSessionAndRedirect(true, $name, $lastname, $surname, $email, $phone);
}

$pdo = getPDO();

$query = "SELECT email AS _email, phone AS _phone FROM `Users`
            WHERE Users.email = :email OR Users.phone = :phone";

$params = [
    'email' => $email,
    'phone' => $phone,
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die($e->getMessage());
}

if ($data['_email'] == $email) {
    $_SESSION['validation']['email'] = 'Пользователь с таким email уже существует';
}

if ($data["_phone"] == $phone) {
    $_SESSION['validation']['phone'] = 'Пользователь с таким телефоном уже существует';
}

if (!empty($_SESSION['validation'])) {
    setOldValuesToSessionAndRedirect(true, $name, $lastname, $surname, $email, $phone);
}

$query = "INSERT INTO Users (name, lastname, surname, email, phone, password) 
            VALUES (:name, :lastname, :surname, :email, :phone, :password)";
$params = [
    'name'  => $name,
    'lastname' => $lastname,
    'surname' => $surname,
    'email' => $email,
    'phone' => $phone,
    'password' => password_hash($password, PASSWORD_DEFAULT),
];

$stmt = $pdo->prepare($query);

try {
    $stmt->execute($params);
} catch (Exception $e) {
    die($e->getMessage());
}
$_SESSION['old']['email'] = $email;
redirect("/../index.php");
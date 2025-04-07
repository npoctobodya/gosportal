<?php
session_start();
function redirect(string $path){
    header("Location: $path");
    die();
}

function isInvalid(string $fieldName): void {
    if (isset($_SESSION['validation'][$fieldName])) {
        echo "<small>" . $_SESSION['validation'][$fieldName] . "<br></small>";
        unset($_SESSION['validation'][$fieldName]);
    }
}

function setOldValue(string $fieldName): void {
    if (isset($_SESSION['old'][$fieldName])) {
        echo 'value="'. $_SESSION['old'][$fieldName] . '"';
        unset($_SESSION['old'][$fieldName]);
    }
}

function cyrilicAndSpacesValidation(string $str, string $key, string $outMessage): void {
    if (!preg_match("~^[А-ЯЁ][а-яё]*$~u", $str)) {
        $_SESSION['validation'][$key] = $outMessage . ' содержать только символы кириллицы';
    }
}
function setOldValuesToSessionAndRedirect($redirect, $name, $lastname, $surname, $email, $phone): void {
    $_SESSION['old']['name'] = $name;
    $_SESSION['old']['lastname'] = $lastname;
    $_SESSION['old']['surname'] = $surname;
    $_SESSION['old']['email'] = $email;
    $_SESSION['old']['phone'] = $phone;
    if ($redirect) {
        redirect("/register.php");
    }
}

function getPDO(): PDO {
    try {
        return new PDO("mysql:host=MySQL-8.0;dbname=GosPortal", 'root', null);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function findUser(string $email): array|bool {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM Users
                                WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function currentUser(): array|false {
    $pdo = getPDO();

    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM Users
                                WHERE user_id = :userId");
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function logout(): void {
    unset($_SESSION['user']['id']);
    redirect("/../index.php");
}

function checkAuth(): void {
    if (!isset($_SESSION['user']['id'])) {
        redirect('/index.php');
    }
}

function checkGuest(): void {
    if (isset($_SESSION['user']['id'])) {
        redirect('/main.php');
    }
}
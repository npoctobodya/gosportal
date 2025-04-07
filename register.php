<?php 
require_once(__DIR__ ."/helpers.php");

checkGuest();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
    body {
        font-family: Geneva, sans-serif;
        background-color: #e6e6e7;
        background: #e6e6e7;
        background: -webkit-radial-gradient(circle, #e6e6e7 0%, #53536c 100%);
        background: radial-gradient(circle, #e6e6e7 0%, #53536c 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    
    .login-container {
        max-width: 400px;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        -webkit-box-shadow: 0px 0px 100px 0px rgba(0, 0, 0, 0.59);
        -moz-box-shadow: 0px 0px 100px 0px rgba(0, 0, 0, 0.59);
        box-shadow: 0px 0px 100px 0px rgba(0, 0, 0, 0.59);
        /*box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);*/
    }
    
    h2 {
        text-align: center;
        font-size: 1.8em;
        letter-spacing: 0.02em;            
    }
    
    input {
        width: 97%;
        padding: 10px 0px 10px 10px;
        margin: 15px 0px 1px 0px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }
    
    #registerbutton {
        font-size: 0.95em;
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        background-color: rgb(51, 51, 51);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }
    
    #registerbutton:hover {
        background-color: rgb(71, 71, 71);
    }
    
    #logbutton {
        font-size: 0.95em;
        text-decoration: none;
        color: #007bff;
        border: none;
        background-color: white;
        padding-left: 0px;
        padding-right: 0px;
        cursor: pointer;
    }
    
    #logbutton:hover {
        text-decoration: underline;
        color: #0056b3;
    }
    
    .footer {
        text-align: center;
        margin-top: 10px;
    }

    small {
        color: red;
    }
    </style>
</head>
<body>

<div class="login-container">
    <h2 style="color: black;">Регистрация</h2>
    <form action="actions/register.php" method="POST">
        <input type="text" name="name" placeholder="Имя" required title="Имя может состоять из любых символов кириллицы"
        <?php setOldValue('name');?>>
        <?php isInvalid('name');?>
        <input type="text" name="lastname" placeholder="Фамилия" required title="Фамилия может состоять из любых символов кириллицы"
        <?php setOldValue('lastname');?>>
        <?php isInvalid('lastname');?>
        <input type="text" name="surname" placeholder="Отчество (при наличии)" title="Отчество может состоять из любых символов кириллицы"
        <?php setOldValue('surname');?>>
        <?php isInvalid('surname');?>
        <input type="text" name="email" placeholder="Электронная почта" required title="Обязательно указывайте полный email, например: ivan.ivanov@mail.com"
        <?php setOldValue('email');?>>
        <?php isInvalid('email');?>
        <input type="tel" name="phone" placeholder="Номер телефона (при наличии)" title="Указывайте телефон в формате +7xxxxxxxxxx или 8xxxxxxxxxx"
        <?php setOldValue('phone');?>>
        <?php isInvalid('phone');?>
        <input type="password" name="password" placeholder="Пароль" required title="Пароль может состоять из любых символов">
        <input type="password" name="repeatPassword" placeholder="Повторите пароль" required title="Пароль может состоять из любых символов">
        <?php isInvalid('repeatPassword');?>
        <a id="logbutton" href="index.php">Авторизация</a><br>
        <button id="registerbutton" type="submit">Зарегистрироваться</button>
    </form>
</div>
</body>
</html>
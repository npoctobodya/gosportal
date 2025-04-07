<?php 
require_once(__DIR__ ."/helpers.php");

checkGuest();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        }

        h2 {
            text-align: center;
            color: black;
        }

        input {
            width: 97%;
            padding: 10px 0px 10px 10px;
            margin: 15px 0px 1px 0px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        #vhod {
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

        #vhod:hover {
            background-color: rgb(71, 71, 71);
        }

        #forgpass, #regbutton {
            font-size: 0.95em;
            text-decoration: none;
            color: #007bff;
            border: none;
            background-color: white;
            padding-left: 0px;
            padding-right: 0px;
            cursor: pointer;
        }
        
        #forgpass:hover, #regbutton:hover {
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
    <h2>Вход</h2>
    <form action="actions/login.php" method="POST">
        <input type="text" name="email" placeholder="Электронная почта" title="Введите электронную почту" required
        <?php setOldValue('email');?>>
        <?php isInvalid('email');?>
        <input type="password" name="password" placeholder="Пароль" title="Введите пароль" required
        <?php setOldValue('password');?>>
        <?php isInvalid('password');?>
        <button id="forgpass" type="button">Забыли пароль?</button><br>
        <a id="regbutton" href="register.php">Зарегистрироваться</a>
        <button id="vhod" type="submit">Войти</button>
        
    </form>
</div>
</body>
</html>
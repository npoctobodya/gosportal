<?php 
require_once(__DIR__ ."/helpers.php");

checkAuth();

$user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ГосПортал</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e9ecef;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hidden {
            display: none;
        }
        .visible {
            display: block;
        }
        
        .navbar {
            background-color: #343a40;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 15px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #495057;
            border-radius: 8px;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            width: 300px;
        }

        .search-container button[type="submit"] {
            width: 36px;
            height: 36px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 5px;
            transition: background-color 0.3s;
        }

        .search-container button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .container {
            padding: 10px;
            margin: 10px 10px 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #343a40;
        }

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 35px 0px;
            bottom: 0;
            margin-top: auto;
        }

        a:visited {
            color: blue;
        }
        
        .buttons button:hover{
            transform: scale(0.95); 
        }
        
        .buttons {
            display: flex; 
            justify-content: space-around; 
            padding: 10px 0px 30px;
            background-color: #343a40;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);     
        }
        
        .buttons img{
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
        
        .buttons button{
            color: white;
            border: none;
        }
        
        .navbar button{
            height: 30px;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .navbar button:hover{
            transform: scale(0.95); 
        }
        
        .edit-form {
            display: none;
            margin-top: 15px;
        }

        .edit-form input {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        
        .lk_button{
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
        
        .navbar a{
            font-size: calc(100% - 5px);
            border-radius: 8px;
            cursor: pointer;
            margin-left: 5px;
            transition: background-color 0.3s;
        }
        
        .hidden-info {
            display: none;
        }

        .buttons_acc {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .toggle-button {
            margin: 0px 2px 0px 2px;
        }

        @media (max-width: 780px) {
            .navbar {
                flex-direction: column;
            }

            .search-container {
                padding: 20px 0px 20px 0px;
                width: 100%;
            }

            .navbar a{
                font-size: calc(100% - 5px);
                border-radius: 8px;
                cursor: pointer;
                margin-left: 5px;
                transition: background-color 0.3s;
            }
            
            .buttons{
                flex-wrap: wrap; 
            }

            .buttons img{
                width: 30px;
                height: 30px;
            }

            .search-container input[type="text"]        
            {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <form class="buttons_acc" action="actions/logout.php" method="POST">
            <button class="toggle-button" data-target="div1" type="button">Главная</button>
            <button class="toggle-button" data-target="div2" type="button">Личный кабинет</button>
            <button class="toggle-button" data-target="div3" type="button">Контакты</button>
            <button class="toggle-button" type="submit">
                <img height="30" src="images/logout.png">
            </button>
        </form>
        <div class="search-container">
            <input type="text" placeholder="Поиск...">
        </div>
    </div>
    
        <div class="buttons">
            <button class="toggle-button" data-target="div4" style="background-color: #00000000"><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/like--v1.png" alt="like--v1"/><br>здоровье</button>
            <button class="toggle-button" data-target="div5" style="background-color: #00000000"><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/document--v1.png" alt="document--v1"/><br>документы</button>
            <button class="toggle-button" data-target="div6" style="background-color: #00000000"><img width="50" height="50" src="https://img.icons8.com/glyph-neue/50/FFFFFF/car.png" alt="car"/><br>транспорт</button>
            <button class="toggle-button" data-target="div6" style="background-color: #00000000"><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/law.png" alt="law"/><br>штрафы</button>
            <button class="toggle-button" data-target="div6" style="background-color: #00000000"><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/categorize.png" alt="categorize"/><br>прочее</button>
        </div>
        
    <div id="div1" class="visible">
        
        <div class="container">
            <h2>Добро пожаловать на наш сайт!</h2>
            <p>Здесь Вы можете найти информацию о различных государственных услугах, подать заявки и получить консультации.</p>
        </div>
        
        <h2 style="padding-left: 20px">Популярное</h2>
        
        <div class="container">
            <h2>Мои документы</h2>
            <p>Здесь вы можете найти информацию о Ваших добавленных документах.</p>
        </div>
    
        <div class="container">
            <h2>Запись к врачу</h2>
            <p>Здесь Вы можете записаться на приëм к врачу в вашем городе.</p>
        </div>
    
    </div>
    
    <div id="div2" class="hidden">
<main>
    <div class="container">
        <section class="profile">
            <h2>Добро пожаловать, <?php echo $user['name'];?></h2>
            <p>Email: <span id="userEmail"><?php echo $user['email'];?></span></p>
            <p>Телефон: <span id="userPhone"><?php echo $user['phone'];?></span></p>
            <button class="lk_button" id="editButton">Редактировать профиль</button>

            <div class="edit-form" id="editForm">
                <input type="text" id="newEmail" placeholder="Новый Email" />
                <input type="text" id="newPhone" placeholder="Новый телефон" />
                <button class="lk_button" id="saveButton">Сохранить изменения</button>
                <button class="lk_button" id="cancelButton">Отмена</button>
            </div>
        </section>
    </div>
    <div class="container">
        <section class="applications">
            <h2>Ваши заявления</h2>
            <table>
                <thead>
                    <tr>
                        <th>Номер заявления</th>
                        <th>Дата подачи</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#123456</td>
                        <td>01.01.2024</td>
                        <td>В обработке</td>
                    </tr>
                    <tr>
                        <td>#789012</td>
                        <td>15.02.2024</td>
                        <td>Завершено</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    <div class="container">
        <section class="notifications">
            <h2>Уведомления</h2>
            <ul>
                <li>Ваше заявление #123456 было принято.</li>
                <li>Напоминаем о необходимости предоставить документы до 01.01.2025.</li>
            </ul>
        </section>
    </div>
    </main>
    </div>
    
    <div id="div3" class="hidden">
        <div class="container">
            <h2>Связаться с нами</h2>
            <img src="gmaillogo.png" style="width: 25px; height: 25px; padding-left: 2px"><br>
            <a href="mailto:ivanov.bogdan.ru@gmail.com">ivanov.bogdan.ru@gmail.com</a><br><br>
            <img src="vklogo.png" style="width: 30px; height: 30px; padding: 0px"><br>
            <a href="https://vk.com/glonce">vk.com/glonce</a><br>
            <a href="https://vk.com/iamfromhell666">vk.com/iamfromhell666</a><br>
            <a href="https://vk.com/natasha_devkina">vk.com/natasha_devkina</a><br><br>
            <img src="tglogo.png" style="width: 30px; height: 30px; padding: 0px"><br>
            <a href="https://t.me/UnknownPersonG">t.me/UnknownPersonG</a><br>
            <a href="https://t.me/Glonce">t.me/Glonce</a><br>
        </div>
    </div>
    
<div id="div5" class="hidden">  
    <div class="container">
    <h1>Загрузка и управление документами</h1>  
    <p>Здесь вы можете загружать, просматривать и управлять своими документами для получения государственных услуг.</p>  
    
    <h2>Загрузка документа</h2>  
    <form id="documentUploadForm">  
        <label for="documentName">Название документа:</label>  
        <input type="text" id="documentName" name="documentName" required>  

        <label for="documentFile">Выберите файл:</label>  
        <input type="file" id="documentFile" name="documentFile" accept=".pdf, .doc, .docx, .jpg, .png" required>  

        <button class="lk_button" type="submit">Загрузить документ</button>  
    </form>  
    
    <h2>Ваши загруженные документы</h2>  
    <table id="documentsTable">  
        <thead>  
            <tr>  
                <th>Название документа</th>  
                <th>Дата загрузки</th>  
                <th>Действия</th>  
            </tr>  
        </thead>  
        <tbody>  
            <tr>  
                <td>Паспорт_Ивана_Иванова.pdf</td>  
                <td>15 декабря 2024</td>  
                <td><button class="lk_button">Удалить</button></td>  
            </tr>  
            <tr>  
                <td>Справка_о_доходах.docx</td>  
                <td>14 декабря 2024</td>  
                <td><button class="lk_button">Удалить</button></td>  
            </tr>  
        </tbody>  
    </table>  
    
    <h2>Информация о документах</h2>  
    <p>Каждый документ, который вы загружаете, должен соответствовать требованиям государственных органов. Убедитесь, что ваши документы:</p>  
    <ul>  
        <li>Читаемы и хорошо видны;</li>  
        <li>В соответствующем формате (PDF, DOC, JPG и др.);</li>  
        <li>Не превышают максимальный размер файла (например, 5 МБ).</li>  
    </ul>  
     
    </div>  
    </div>    

<div id="div6" class="hidden">  
    <div class="container">
        <h2>В разработке</h2>
    </div>    
</div>  
<div id="div4" class="hidden">
    <div class="container">
        <h2>В данном разделе Вы можете найти информацию, связанную со здоровьем</h2>
        
        <button class="lk_button" onclick="toggleInfo('clinicsInfo')">Найти клиники рядом</button>
        <div id="clinicsInfo" class="hidden-info">
            <div style="width: 100%; height: 400px;">  
                <iframe src="https://yandex.ru/map-widget/v1/-/CCUF6DBR" width="100%" height="100%" frameborder="0"></iframe>  
            </div>  
        </div>

        <button class="lk_button"  onclick="toggleInfo('zapisInfo')">Записаться на прием к врачу</button> 
        <div id="zapisInfo" class="hidden-info">  
            <h3>Запись на прием к врачу</h3>  
    <p>Пожалуйста, выберите врача и удобное время для записи:</p>  
    <form>  
        <label for="doctor">Выберите врача: </label>  
        <select id="doctor" name="doctor">  
            <option value="therapist">Терапевт</option>  
            <option value="dentist">Стоматолог</option>  
            <option value="cardiologist">Кардиолог</option>  
        </select>  
        <label for="date"><br>Выберите дату:    </label> 
        <input type="date" id="date" name="date" required>
        <label for="time"><br>Выберите время:   </label>  
        <input type="time" id="time" name="time" required>  

        <button class="lk_button" type="submit">Записаться</button>  
    </form>  
        </div>  
        <button class="lk_button" onclick="toggleInfo('recommendationsInfo')">Посмотреть рекомендации</button>
        <div id="recommendationsInfo" class="hidden-info">  
            
            <h3>Рекомендации по здоровью:</h3>  
            <ul>  
                <li>Регулярно проходите медицинские осмотры.</li>  
                <li>Соблюдайте сбалансированное питание, включая фрукты и овощи.</li>  
                <li>Занимайтесь физической активностью не менее 30 минут в день.</li>  
                <li>Соблюдайте режим сна, спите не менее 7-8 часов в сутки.</li>  
                <li>Управляйте стрессом с помощью методов релаксации, таких как медитация или йога.</li>  
                <li>Избегайте курения и чрезмерного употребления алкоголя.</li>  
                <li>Пейте достаточное количество воды каждый день.</li>  
            </ul>  
        </div>  
    
        <button class="lk_button">Связаться с консультантом</button>
    </div>
</div>
    
    <div class="footer">
        <p>&copy; 2025 ГосПортал. Все права защищены.</p>
    </div>
    
<script>
    function toggleInfo(infoId) {
        const infoElement = document.getElementById(infoId);
        if (infoElement.style.display === "none" || infoElement.style.display === "") {
            infoElement.style.display = "block";
        } else {
            infoElement.style.display = "none";
        }
    }
</script>
    
    <script>
        const editButton = document.getElementById('editButton');
        const editForm = document.getElementById('editForm');
        
        const userEmail = document.getElementById('userEmail');
        const userPhone = document.getElementById('userPhone');

        const saveButton = document.getElementById('saveButton');
        const cancelButton = document.getElementById('cancelButton');

        editButton.addEventListener('click', () => {
            editForm.style.display = 'block';
            editButton.style.display = 'none'; 
            document.getElementById('newEmail').value = userEmail.textContent; 
            document.getElementById('newPhone').value = userPhone.textContent; 
        });

        saveButton.addEventListener('click', () => {
            const newEmail = document.getElementById('newEmail').value; 
            const newPhone = document.getElementById('newPhone').value; 
            
            userEmail.textContent = newEmail; 
            userPhone.textContent = newPhone;

            editForm.style.display = 'none';
            editButton.style.display = 'block';
        });

        cancelButton.addEventListener('click', () => {
            editButton.style.display = 'block';
            editForm.style.display = 'none';
        });
    </script>
    
    <script>
    const buttons = document.querySelectorAll('.toggle-button');
        const divs = document.querySelectorAll('div[id^="div"]');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const targetDivId = this.getAttribute('data-target');

                divs.forEach(div => {
                    if (div.id === targetDivId) {
                        div.classList.remove('hidden');
                        div.classList.add('visible');
                    } else {
                        div.classList.remove('visible');
                        div.classList.add('hidden');
                    }
                });
            });
        });
</script>
</body>
</html>
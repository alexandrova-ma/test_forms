<? header('Content-Type: text/html; charset=utf-8'); ?>
<html>
<head>
    <meta charset="utf-8">
    <style>
    input, textarea {
        margin-bottom:10px;
    }
    </style>
</head>
<body>
    <h2>Эта форма отправляет данные методом POST</h2>
    <form method="POST" action="form.php">
        <p> Введите ваше имя: </p>
        <input name="name" placeholder="Имя" required> 
        <p> Введите ваш номер телефона: </p>
        <input name="phone" placeholder="+7 (---) --- --"> 
        <p> Введите ваше сообщение: </p>
        <textarea name="message" placeholder="Сообщение" required></textarea> <br/>
        <p>Выберите курсы:</p>
        <label>CSS
            <input type="checkbox" name="course[]" value="CSS"> <br/>
        </label>
        <label>Java Script
            <input type="checkbox" name="course[]" value="JavaScript"> <br/>
        </label>
        <label>PHP
            <input type="checkbox" name="course[]" value="PHP"> <br/>
        </label>
        <p> Выберите время звонка: </p>
        <label>8:00-12:00
            <input type="radio" name="call" value="morning"> <br/>
        </label>
        <label>12:00-17:00
            <input type="radio" name="call" value="day"> <br/>
        </label>17:00-21:00
            <input type="radio" name="call" value="evening"> <br/>
        </label>
        <input type="hidden" name="start-time" value="<? echo date('Y-m-d H:i:s'); ?>"> <br/>
        <input type="hidden" name="password" value="3fc0a7acf087f549ac2b266baf94b8b1">
        <input type="submit">
    </form>
</body>
</html>

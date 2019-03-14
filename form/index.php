<? header('Content-Type: text/html; charset=utf-8'); 
session_start();

if($_GET['do'] == 'logout'){
 unset($_SESSION['admin']);
 session_destroy();
}

if(!$_SESSION['admin']){
 header("Location: enter.php");
 exit;
}
?>
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
        <input type="hidden" name="password" value="68dda9c33f2aedaa94999c3cb7c7d23f">
        <input type="submit">
    </form>
    <a href="index.php?do=logout">Выход</a>
</body>
</html>

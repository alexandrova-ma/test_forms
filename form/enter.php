<? header('Content-Type: text/html; charset=utf-8');
session_start();

if($_SESSION['admin']){
 header("Location: index.php");
 exit;
}
 
$admin = 'admin';
$pass = '5f4dcc3b5aa765d61d8327deb882cf99';

if($_POST['submit']){
 if($admin == $_POST['user'] AND $pass == md5($_POST['pass'])){
 $_SESSION['admin'] = $admin;
 header("Location: index.php");
 exit;
 }
    else {
    echo '<p>Логин или пароль неверны!</p>';
    }
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
<form method="post">
 Username: <input type="text" name="user" /><br />
 Password: <input type="password" name="pass" /><br />
 <input type="submit" name="submit" value="Войти" />
</body>
</html>

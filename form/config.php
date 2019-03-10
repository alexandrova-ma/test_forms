<? 
header('Content-Type: text/html; charset=utf-8');
$db_host = 'localhost'; 
$db_user = 'root'; 
$db_password = ''; 
$db_base = 'form'; 
$to = 'maryy-15@list.ru';
$from = 'From:morost-ruz@mail.ru';
$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$subject = 'Вам пришло письмо с сайта '.$url;
?>


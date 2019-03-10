<? 
header('Content-Type: text/html; charset=utf-8');
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$db_name = 'form'; 
$to = 'maryy-15@list.ru';
$from = 'From:morost-ruz@mail.ru';
$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$opt = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];
?>


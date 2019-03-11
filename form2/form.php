<? 
header('Content-Type: text/html; charset=utf-8');
include_once 'config.php';
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$course = $_POST['course'];
$calling = $_POST['call'];
$sendTime = date('Y-m-d H:i:s');
$startTime = $_POST['start-time'];
$callingRusValues = array("morning" => "8:00-12:00", "day" => "12-00-17:00", "evening" => "17-00-21:00");
$diff = strtotime($sendTime) - strtotime($startTime);

if (strlen($name) <= 2 || preg_match('/[0-9]/u', $name)) {
  echo 'Имя: некорректное значение<br/>';
  return;
}

if (!preg_match("/^\+?[78][-\(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/", $phone)) {
  echo 'Телефон: некорректное значение<br/>';
  return;
}

if ( empty($phone) || empty($course) || empty($calling) ) 
  echo 'Вы заполнили не все поля <br/>';
  
echo 'Имя: '.$name.'<br/>';
if (empty($phone))
  echo 'Телефон: вы не ввели номер телефона <br/>';
echo 'Телефон: '.$phone.'<br/>';
echo 'Сообщение: '.$message.'<br/>';
echo 'Выбранные курсы: ';
if (count($course)==0) {
  echo 'не выбрано';
  }
else {
  foreach ($course as $a) {
  $courseValue.=$a.' ';
  echo $a.' ';
  }
}
if (empty($calling))
  echo '<br/> Время звонка: вы не выбрали время звонка <br/>';
else 
  echo '<br>Время звонка: '.$callingRusValues[$calling].'<br/>';
echo 'Время заполнения формы: '.$diff.' секунд <br/>';

$salt = 'njdfvn84hndvj';
$hesh = md5 ('qwerty123'.$salt);
if ($password == md5('qwerty123'.$salt))
  echo 'Пароли совпадают! <br/>'; 

$body = 'Имя: '.$name."\n".'Телефон: '.$phone."\n".'Сообщение: '.$message."\n".'Выбранные курсы: '.$courseValue
."\n".'Время звонка: '.$callingRusValues[$calling]
."\n".'Время открытия формы: '.$startTime."\n"."Время отправки формы: ".$sendTime."\n"."Время заполнения формы: ".$diff.' секунд';

mail($to, $subject, $body, $from);


$dsn = "mysql:host=$host;dbname=$db_name;";
$pdo = new PDO($dsn, $username, $password, $opt);

$stmt_insert = $pdo->prepare('INSERT INTO messages (name, phone, message, course, calling, startTime, sendTime, diff)
VALUES  (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt_insert->execute(array($name, $phone, $message, $courseValue, $callingRusValues[$calling], $startTime, $sendTime, $diff));

$query_select = $pdo->query('SELECT * FROM `messages`')->fetchAll(PDO::FETCH_UNIQUE);
foreach ($query_select as $row){
    echo $row['id'] . $row['name'] .' '. $row['phone'] .' '. $row['massage'] .' '
    . $row['course'] .' '. $row['calling'] . ' '. $row['startTime'] .' '. $row['sendTime'] .' '. $row['diff'] . "<br/>";
}

?>


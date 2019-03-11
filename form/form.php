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
$password = $_POST['password'];
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

$body = 'Имя: '.$name."\n".'Телефон: '.$phone."\n".'Сообщение: '.$message."\n"
.'Выбранные курсы: '.$courseValue."\n".'Время звонка: '.$callingRusValues[$calling]
."\n".'Время открытия формы: '.$startTime."\n"."Время отправки формы: ".$sendTime."\n"."Время заполнения формы: ".$diff.' секунд';

mail($to, $subject, $body, $from);

// Cоздание подключения к базе данных 
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base) or die('Ошибка' . mysqli_error($link));

 // Записываем в БД 
$query_insert = 'INSERT INTO messages (name, message, phone, course, calling, startTime, sendTime, diff) 
VALUES ("' . $name . '", "' . $message . '", "' . $phone . '", "' . $courseValue . '", 
"' . $callingRusValues[$calling] . '", "' . $startTime . '", "' . $sendTime . '", "' . $diff . '")'; 
mysqli_query($link, $query_insert) or die('Ошибка' . mysqli_error($link)); 

//  Вывод из БД
$query_select = 'SELECT * FROM messages'; 
$result = mysqli_query($link, $query_select) or die('Ошибка' . mysqli_error($link)); 
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {     
    echo $row["id"] . ' ' . $row["name"] . ' ' . $row["message"] . ' ' . $row["phone"]. ' ' . $row["course"]. ' '.
    $row["calling"] . ' ' . $row["startTime"] . ' ' . $row["sendTime"] . ' ' . $row["diff"] . ' ' . ' <br />'; 
} 
mysqli_free_result($result); 
    
// Закрыть подключения к базе данных 
mysqli_close($link); 

?>


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
echo '<table style="border: 1px solid black; border-collapse: collapse; margin-bottom: 5px">';
if ( empty($phone) || empty($course) || empty($calling) ) {
  echo 'Вы заполнили не все поля <br/>';
} 
echo '<tr> <td>Имя:</td>'.'<td>'.$name.'</td> </tr>';
if (empty($phone)) {
  echo '<tr> <td>Телефон:</td> <td>вы не ввели номер телефона</td> </tr>';
}
echo '<tr> <td>Телефон:</td>'.'<td>'.$phone.'</td> </tr>';
echo '<tr> <td>Сообщение:</td>'.'<td>'.$message.'</td> </tr>';
echo '<tr> <td>Выбранные курсы:</td>';
if (count($course)==0) {
  echo '<td>не выбрано</td> </tr>';
}
else {
  foreach ($course as $a) {
  $courseValue.=$a.' ';
  echo '<td>'.$a.' ';
  echo '</td> </tr>';
  }
}
if (empty($calling)) {
  echo '<tr> <td>>Время звонка: </td> <td>вы не выбрали время звонка</td> </tr>';
}
else {
  echo '<tr> <td>Время звонка:</td> '.'<td>'.$callingRusValues[$calling].'</td></tr>';
}
if ($diff>=3600) {
  $diffHour = intval ($diff/3600);
  $diffRemainder = $diff%3600;
  if ($diffRemainder>=60) {
    $diffMin = intval ($diffRemainder/60);
    $diffSec = $diffRemainder%60;
  }
  echo '<tr> <td>Время заполнения формы: </td> '.'<td>'.$diffHour.' часов '.$diffMin.' минут '.$diffSec.' секунд</td> </tr>';
}
if ($diff>=60 AND $diff<3600) {
  $diffMin2 = intval ($diff/60);
  $diffSec2 = $diff%60;
  echo '<tr> <td>Время заполнения формы: </td>'.'<td>'.$diffMin2.' минут '.$diffSec2.' секунд</td></tr>';
}
else {
 if ($diff<60) {
  echo '<tr> <td>Время заполнения формы: </td>'.'<td>'.$diff.' секунд</td></tr>';
  }
}
echo '</table>';

$salt = 'njdfvn84hndvj';
if ($password == md5('qwerty123'.$salt))
  echo 'Пароли совпадают! <br/>'; 

$body = 'Имя: '.$name."\n".'Телефон: '.$phone."\n".'Сообщение: '.$message."\n".'Выбранные курсы: '.$courseValue."\n".'Время звонка: '.$callingRusValues[$calling]
."\n".'Время открытия формы: '.$startTime."\n"."Время отправки формы: ".$sendTime."\n"."Время заполнения формы: ".$diff.' секунд';

$mail = mail($to, $subject, $body, $from);
if ($mail) {
  echo 'Письмо отправлено! <br/>';
}
else {
  echo 'Письмо не отправлено! <br/>';
}
/*
// Cоздание подключения к базе данных 
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base) or die('Ошибка' . mysqli_error($link));

 // Записываем в БД 
$query_insert = 'INSERT INTO messages (name, message, phone, course, calling, startTime, sendTime, diff) 
VALUES ("' . $name . '", "' . $message . '", "' . $phone . '", "' . $courseValue . '", "' . $callingRusValues[$calling] . '", "' . $startTime . '", "' . $sendTime . '", "' . $diff . '")'; 
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

*/
?>



<? 
// ----------------------------конфигурация-------------------------- // 
 
$adminemail="info@cisoncology.org";  // e-mail админа 
 
 
$date=date("d.m.y"); // число.месяц.год 
 
$time=date("H:i"); // часы:минуты:секунды 
 
$backurl="http://cisoncology.org/index.html";  // На какую страничку переходит после отправки письма 


header('Content-type: text/html; charset=utf-8');
 
//---------------------------------------------------------------------- // 
 
  
 
// Принимаем данные с формы 
 
$fio = $_POST['fio'];
$email = $_POST['email'];
 
  
 
// Проверяем валидность e-mail 
 
if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", 
strtolower($email))) 
 
 { 
 
  echo 
"<center>Вернитесь <a 
href='javascript:history.back(1)'><B>назад</B></a>. Вы 
указали неверные данные!"; 
 
  } 
 
 else 
 
 { 
 
 
$msg=" 
Имя: $fio
 
 
E-mail: $email
 

"; 
 
  
 
 // Отправляем письмо админу  
 
mail("$adminemail", "$date $time Запрос промо-кода для приобретения справочника 2015", "$msg"); 
 
  
 
// Сохраняем в базу данных 
 
$f = fopen("message.txt", "a+"); 
 
fwrite($f," \n $date $time Сообщение от $fio"); 
 
fwrite($f,"\n $msg "); 
 
fwrite($f,"\n ---------------"); 
 
fclose($f); 
 
  
 
// Выводим сообщение пользователю 
 
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 3000); 
//--></script> 
 
 
<p>Уважаемый гость!</p>
<p>Ваш промо-код будет выслан на указанный адрес электронной почты.</p>
<p>Спасибо!</p>


";  
exit; 
	

 
 } 
 
?>

<?php

$backurl="http://cisoncology.org/index.php#promo-form";  // На какую страничку переходит после отправки письма 

/* Проверяем, существуют ли переменные, которые передала форма обратной связи.
Если не существуют, то мы их создаем.
Если форма передала пустые значения, мы их удаляем */
if (isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);}}
if (isset($_POST['email'])) {$email = $_POST['email']; if ($email == '') {unset($email);}}
if (isset($_POST['message'])) {$message = $_POST['message']; if ($message == '') {unset($message);}}
if (isset($_POST['captcha_validation'])){$captcha_validation = $_POST['captcha_validation']; if ($captcha_validation == '') {unset($captcha_validation);}}
if (isset($_POST['captcha'])){$captcha = $_POST['captcha'];}
 
/* Проверяем, заполнены ли все поля */
if (isset($name) && isset($email) && isset($captcha_validation))
{
 
/* Проверяем правильность ввода капчи */
if ($captcha == $captcha_validation)
{
 
/* если капча верна, отправляем сообщение */
/* Настройки сообщения */
$address = "info@cisoncology.org";
$sub = "Запрос  промо-кода";
$mes = "Имя: $name \nE-mail: $email \n";
 
/* Уведомление об отправке письма */
$verify = mail ($address,$sub,$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$email");
if ($verify == 'true')
{
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 3000); 
//--></script> 
<p>Уважаемый гость!</p>
<p>Ваш промо-код будет выслан на указанный адрес электронной почты.</p>
<p>Спасибо!</p>
"; 
}
else
{
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 3000); 
//--></script> 
<p>Сообщение не отправлено!</p>
"; 
}
}
else
{
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 3000); 
//--></script> 
<p>Вы неправильно ввели цифры с картинки</p>
"; 
}
 
}
else
{
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 3000); 
//--></script> 
<p>Вы заполнили не все поля!</p>
"; 
}
?>
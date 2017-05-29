<?php

$backurl="http://cisoncology.org/index.php#promo-form";  // На какую страничку переходит после отправки письма 

$errors = "";

/*
Проверяем, существуют ли переменные, которые передала форма обратной связи.
Если не существуют, то текст ошибки будет записан в переменную.
*/

if (!empty($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $errors .= "Не введено значение поля 'Имя'<br>";
}

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $errors .= "Не введено значение поля 'e-mail'<br>";
}

if (!empty($_POST['captcha_validation'])){
    $captcha_validation = $_POST['captcha_validation'];
} else {
    $errors .= "Не введено значение поля 'Captcha'<br>";
}

if (!empty($_POST['captcha'])){
    $captcha = $_POST['captcha'];
} else {
    $errors .= "Просим извинить нас! Форма временно не работает!<br>";
}

if (!empty($errors)) {
    echo $errors;
    return false;
} else if ($captcha != $captcha_validation) {
    echo "Вы неправильно ввели значение поля 'Captcha'";
    return false;
} else {

    $address = "info@cisoncology.org";
    $sub = "Запрос промо-кода";
    $promoCode = "ADIOR-"mt_rand(100000, 999999);
    $mes1 = "Спасибо за ваше обращение! \nИмя: $name \nE-mail: $email \nПромокод: $promoCode";
    $mes2 = "На сайте cisoncology.org поступил запрос на промо-код: \nИмя: $name \nE-mail: $email \nПромокод: $promoCode";

    /* Уведомление об отправке письма */
    $verifyAdminMailing = mail($address, $sub, $mes2, "Content-type:text/plain; charset = utf-8\r\nFrom:$email");
    $verifyCustomerMailing = mail($email, $sub, $mes1, "Content-type:text/plain; charset = utf-8\r\nFrom:$address");
    if ($verifyAdminMailing == 'true') {
        echo "Ваш промо-код будет выслан на указанный адрес электронной почты.<br> Спасибо!";
    } else {
        echo "Извините, произошла ошибка отправки промо-кода!";
    }
}

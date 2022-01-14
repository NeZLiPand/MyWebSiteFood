<?php
session_start();

$email = $_POST['email'];
$message = $_POST['message'];
$error = '';
if (trim($email) == '')
      $error = 'Введіть ваш email!';
else if (trim($message) == '')
      $error = 'Введіть ваше повідомлення!';
else if (strlen($message) < 5)
      $error = 'Повідомлення занадто мале, воно повинно мати не менше 5 символів!';
if ($error != '') {
      echo $error;
      exit;
}
$subject = "=?utf-8?b?" . base64_encode("Тестове повідомлення") . "?=";
$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html;charset=utf-8\r\n";
mail('gjgrfjyfnfrfz@gmail.com', $subject, $message, $headers);
header('Location: /about.php');

<?php
require_once 'connect.php';
//считывание данных из формы
$fio = $_POST['fio'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$auto_number = $_POST['auto_number'];

$check_user = $mysqli->query("SELECT * FROM `user` WHERE `email` = '$email'")->fetch_assoc(); // проверка на занятость логина  
if ($check_user) {
  echo json_encode($message = array('success' => false, 'message' => 'Логин занят'), JSON_UNESCAPED_UNICODE);
} else {
  $add_user = "INSERT INTO `user` (`id`, `fio`, `phone_number`, `email`, `pass`, `auto_serial`, `role`) VALUES (NULL, '$fio', '$phone ', '$email', '$pass', '$auto_number', 'user')";
  $mysqli->query($add_user);
  if ($mysqli->affected_rows > 0) { // проверка на успешность запроса
    echo json_encode($message = array('success' => true, 'message' => 'Регистрация прошла успешно'), JSON_UNESCAPED_UNICODE);
  } else {
    echo  json_encode($message = array('success' => false, 'message' => 'Произошла ошибка в бд'), JSON_UNESCAPED_UNICODE);
  }
}

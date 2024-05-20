<?php
require_once 'connect.php';
//считывание данных из формы
$email = $_POST['email'];
$pass = $_POST['pass'];
$add_user = $mysqli->query("SELECT * FROM `user` WHERE `email` = '$email'")->fetch_assoc();

if ($add_user) { // проверка на наличие логина

  $check_pass = $mysqli->query("SELECT * FROM `user` WHERE `email` = '$email' and pass = '$pass'")->fetch_assoc(); // провекра на совпаление пароля
  if ($check_pass) {
    session_start();
    $_SESSION['user']['id'] = $add_user['id']; // запись данных в php сессию 
    $_SESSION['user']['role'] = $add_user['role'];
    if ($_SESSION['user']['role'] == 'admin') {
      echo json_encode($message = array('success' => true, 'message' => 'admin'), JSON_UNESCAPED_UNICODE);
    } else {
      echo json_encode($message = array('success' => true, 'message' => 'Авторизация успешно прошла'), JSON_UNESCAPED_UNICODE);
    }
  } else { // ответ на клиент о неверном пароле

    echo json_encode($message = array('success' => false, 'message' => 'Неверный пароль'), JSON_UNESCAPED_UNICODE);
  }
} else { // ответ на клиент о неверном логине

  echo json_encode($message = array('success' => false, 'message' => 'Логин не найден'), JSON_UNESCAPED_UNICODE);
}

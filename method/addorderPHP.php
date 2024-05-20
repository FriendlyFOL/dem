<?php
require_once 'connect.php';
//считывание данных из формы
session_start();
$auto = $_POST['auto'];
$date = $_POST['date'];
$id_user = $_SESSION['user']['id'];

$check_order = $mysqli->query("SELECT * FROM `orders` WHERE `date` = '$date ' AND  `id_auto` = '$auto'")->fetch_assoc(); // проверка на занятость даты заявки 
if ($check_order) {


  echo json_encode($message = array('success' => false, 'message' => 'Это дата занята'), JSON_UNESCAPED_UNICODE);
} else {
  $mysqli->query("INSERT INTO `orders` (`id_order`, `id_user`, `id_auto`, `status`, `date`) VALUES (NULL, '$id_user', '$auto ', 'Новое', '$date');");
  if ($mysqli->affected_rows > 0) { // проверка на успешность запроса
    echo json_encode($message = array('success' => true, 'message' => 'Заявка успешно создана'), JSON_UNESCAPED_UNICODE);
  } else {

    echo json_encode($message = array('success' => false, 'message' => 'Произошла ошибка при записи в бд'), JSON_UNESCAPED_UNICODE);
  }
}

<?php
require_once 'connect.php';
//считывание данных из формы
$status = $_POST['status'];
$id_order = $_POST['id_order'];

$add_order = $mysqli->query("UPDATE `orders` SET `status` = '$status' WHERE `orders`.`id_order` = $id_order");
if ($mysqli->affected_rows > 0) {
  echo json_encode($message = array('success' => true, 'message' => 'Статус успешно обновлен'), JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode($message = array('success' => false, 'message' => 'Произошла ошибка при изменении статуса'), JSON_UNESCAPED_UNICODE);
}

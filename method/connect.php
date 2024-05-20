<?php
mysqli_report(MYSQLI_REPORT_OFF);
$mysqli = @new mysqli('localhost', 'root', '', 'demo1605'); //подключение к бд
if ($mysqli->connect_error) {
  echo ('Connection error: ' . $mysqli->connect_error);
}

<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
  header("Location: index.php");
}
// проверка, является ли пользователь авторизованным, если не является, то переместить на index.php
if ($_SESSION['user']['role'] == 'admin') {
  header("Location: admin.php");
}
// проверка, является ли пользователь админом, если является, то переместить на admin.php
require_once 'method/connect.php';
$id = $_SESSION['user']['id'];
// получение информации о заявках, путем sql запроса с использование id пользователя 
$get_info_orders = $mysqli->query("SELECT * FROM `orders` INNER JOIN user ON orders.id_user = user.id INNER JOIN auto ON auto.id = orders.id_auto WHERE `id_user` = $id ");
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href='style.css'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Эх,прокачу!</title>
</head>

<body>
  <header class="container-header">
    <div class="header">
      <div class="logo">
        <img src="img/logo.png" alt="" class="logo-img">
        <div class="logo-text">
          Эх,прокачу!
        </div>
      </div>

      <ul class="nav">
        <li class="nav-item"><a href='addorder.php'>Создать заявку</a></li>
        <li class="nav-item"><a href='history.php'>История заявок</a></li>
        <li class="nav-item"><a href="method/exit.php">Выйти</a></li>

      </ul>
    </div>
  </header>

  <main class="container-main">

    <div class="main-history">
      <!-- проверка, есть ли у юзера заявки -->
      <?php if ($mysqli->affected_rows == 0) : ?>
        <h1>У вас пока нет заявок</h1>
      <?php else : ?>
        <?php while ($row = $get_info_orders->fetch_assoc()) : ?>
          <div class="container-info-user ">
            <div class="info-user">
              <!--   Вывод заявок посредством цикла while -->
              Номер заявки:
              <label> <?= $row['id_order'] ?></label>
              Авто:
              <label> <?= $row['name'] ?></label>
              Дата:
              <label> <?= $row['date'] ?></label>
              Статус заявки:
              <label> <?= $row['status'] ?></label>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </main>
  <footer class="container-footer">
    <div class="footer">

      <label>2024</label>
      <label>COPYRIGHT Ilya Rusakov</label>
    </div>
  </footer>
</body>

</html>
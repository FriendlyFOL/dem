<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
  header("Location: index.php");
}
// проверка, является ли пользователь авторизованным, если не является, то переместить на index.php
if ($_SESSION['user']['role'] != 'admin') {
  header("Location: addorder.php");
}
// проверка, является ли авторизованный пользователь обычным юзером, если  является, то переместить на addorder.php
require_once 'method/connect.php';

$get_info_orders = $mysqli->query("SELECT * FROM `orders` INNER JOIN user ON orders.id_user = user.id INNER JOIN auto ON auto.id = orders.id_auto;");
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

      <ul class="nav admin">
        <li class="nav-item"><a href="method/exit.php">Выйти</a></li>

      </ul>
    </div>
  </header>

  <main class="container-main">
    <div class="main-history">
      <?php if ($mysqli->affected_rows == 0) : ?>
        <h1>Заявок пока нет</h1>
      <?php else : ?>
        <?php while ($row = $get_info_orders->fetch_assoc()) : ?>
          <div class="admin-info ">
            <div class="info-user">
              <!--   Вывод заявок посредством цикла while -->
              <form class="form-admin" action="method/add_status.php" method="post">
                <h3>Номер заявки:</h3>
                <h5> <?= $row['id_order'] ?></h5>
                <input hidden name="id_order" value="<?= $row['id_order'] ?>">
                <h3>Авто:</h3>
                <h5> <?= $row['name'] ?></h5>
                <h3> Дата: </h3>
                <h5> <?= $row['date'] ?></h5>
                <h3> ФИО:</h3>
                <h5> <?= $row['fio'] ?></h5>
                <h3> Номер телефона: </h3>
                <h5> <?= $row['phone_number'] ?></h5>
                <h3> Email: </h3>
                <h5> <?= $row['email'] ?></h5>
                <h3> Статус заявки:</h3>
                <h5> <?= $row['status'] ?></h5>
                <?php if ($row['status'] == 'Новое') : ?>
                  <select name='status'>
                    <option value=" Подтверждено">Подтверждено</option>
                    <option value="Отклонено">Отклонено</option>
                  </select>
                  <input type='submit' class='btn btn-primary btn-admin ' value="Отправить">
                <?php endif; ?>
              </form>
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
<script>
  // добавление каждой заявке функции, при которой происходит отправка данных в php файл, а также их получение и дальнейшная обработка

  document.querySelectorAll('.form-admin').forEach(form => {
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var form = event.target
      err = document.getElementById('err')
      fetch(form.action, {
          method: form.method,
          body: new FormData(form)
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert(data.message)
            window.location = 'admin.php'
          } else {
            alert(data.message)
            window.location = 'admin.php'
          }
        })
        .catch()
    })
  })
</script>
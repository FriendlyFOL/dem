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
$get_auto = $mysqli->query("SELECT * FROM `auto`"); // запрос на вывод всех машин 
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
    <div class="main">
      <div class="container-form auth">
        <form action="method/addorderPHP.php" method="post" class="reg-form" id="form-add-order">
          Авто
          <select name='auto'>
            <?php while ($row = $get_auto->fetch_assoc()) : ?>
              <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endwhile; ?>
          </select>
          Дата
          <input name='date' type="date" required>
          <input type="submit" class="btn btn-primary" value="Отправить">
          <label id='err' class="err"></label>
        </form>
      </div>
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
  // функция, для отправки данных в php файл, а также получения ответа и его последующей обработки
  document.getElementById('form-add-order').addEventListener('submit', (event) => {
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

          window.location = 'history.php'

        } else {
          err.innerHTML = data.message;
        }
      })
      .catch()
  })
</script>
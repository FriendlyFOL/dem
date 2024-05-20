<!DOCTYPE html>
<html lang="ru">
<?php
session_start();
if (isset($_SESSION['user']['id'])) {
  header("Location: addorder.php");
}
// проверка, является ли пользователь авторизованным, если  является, то переместить на addorder.php

?>

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

      <ul class="nav auth-nav ">
        <li class="nav-item"><a href="index.php">Регистрация</a></li>
        <li class="nav-item"><a href='auth.php'>Авторизация</a></li>
      </ul>
    </div>
  </header>

  <main class="container-main">
    <div class="main">
      <div class="container-form auth">
        <form action="method/authPHP.php" method="post" class="reg-form" id="formlogin">
          Логин
          <input name='email' required>
          Пароль
          <input name='pass' required type="password">
          <input type="submit" class="btn btn-primary" value="Авторизироваться">
          <label id='err' class="err"></label>
        </form>
      </div>
      <img src="img/6.jpg" alt="" class="img-main">
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
  document.getElementById('formlogin').addEventListener('submit', (event) => {
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
          if (data.message == 'admin') {
            alert("Добро пожаловать, админ")
            window.location = 'admin.php'
          } else {
            alert(data.message)
            window.location = 'addorder.php'
          }
        } else {
          err.innerHTML = data.message;
        }
      })
      .catch()
  })
</script>
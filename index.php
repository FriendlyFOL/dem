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

      <ul class="nav auth-nav ">
        <li class="nav-item"><a href="index.php">Регистрация</a></li>
        <li class="nav-item"><a href='auth.php'>Авторизация</a></li>
      </ul>
    </div>
  </header>

  <main class="container-main">
    <div class="main">
      <div class="container-form">
        <form action="method/regPHP.php" method="post" class="reg-form" id='formreg'>
          ФИО
          <input name='fio' required pattern="^[A-Za-zА-Яа-яёЁ]+\s[A-Za-zА-Яа-яёЁ]+\s[A-Za-zА-Яа-яёЁ]+$" title="Иванов Иван Иванович">
          Номер телефона
          <input name='phone' required pattern="^7-\d{3}-\d{3}-\d{2}-\d{2}$" title="7-ХХХ-ХХХ-ХХ-ХХ">
          Email
          <input name='email' required type="email">
          Вод удостоврение
          <input name='auto_number' required pattern="^\d{2}\s\d{2}\s\d{6}$" title="ХХ ХХ ХХХХХХ">
          Пароль
          <input name='pass' required pattern="^(?=.*\d).{3,}$" type="password" title="минимум 1 цифра, минимум 3 символа">
          <input type="submit" class="btn btn-primary" value="Зарегестрироваться">

          <label id='err' class="err"></label>
        </form>
      </div>
      <img src="img/4.jpg" alt="" class="img-main">
    </div>
  </main>

  <footer class="container-footer">
    <div class="footer">

      <h4>2024</h4>
      <h4>COPYRIGHT Ilya Rusakov</h4>
    </div>
  </footer>
</body>

</html>
<script>
  // функция, для отправки данных в php файл, а также получения ответа и его последующей обработки
  document.getElementById('formreg').addEventListener('submit', (event) => {
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
          window.location = 'auth.php'
        } else {
          err.innerHTML = data.message;
        }
      })
      .catch()
  })
</script>
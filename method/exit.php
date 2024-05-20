<?php
// старт, удаление данных и уничтожение сессиии
session_start();
session_unset();
session_destroy();
header("Location: ../auth.php");

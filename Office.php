<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/RegAuth/auth.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<p>Привет <?= $_COOKIE['user'] ?>.<a href="/exit.php">Выход</a></p>
<script src="lib/jquery-3.6.1.js"></script>
<script src="js/RegAuth.js"></script>
</body>
</html>
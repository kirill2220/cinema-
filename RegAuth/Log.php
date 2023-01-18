<?php
session_start();
$_SERVER['DOCUMENT_ROOT'] . '/RegAuth/auth.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style_reg_auth.css">
    <title>Document</title>
    <link href="../css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/global_style.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="../lib/jquery-3.6.1.js"></script>
</head>
<body>
<noscript>Включите JS</noscript>
<?php
if (!isset($_COOKIE['user'])):
    ?>

    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Добро пожаловать в DreamCinema</h1>
                            <p class="lead">
                                Войдите в свой аккаунт для продолжения
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="../images/user.png" alt="Charles Hall"
                                             class="img-fluid rounded-circle" width="132" height="132"/>
                                    </div>
                                    <form>
                                        <div class="mb-3">
                                            <label for="login" class="form-label">Логин</label>
                                            <input id="login" class="form-control form-control-lg" type="text"
                                                   name="login" pattern="[a-zA-Z0-9]+" placeholder="Введите ваш логин"
                                                   required/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Пароль</label>
                                            <input class="form-control form-control-lg" id="password" type="password"
                                                   name="password" placeholder="Введите ваш пароль" required/>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button class="login-but btn btn-lg btn-primary" type="submit" name="login"
                                                    value="login">Войти
                                            </button>
                                        </div>
                                        <div class="alert alert-danger msg alert-none text-center" role="alert">
                                        </div>
                                        <div class="text-center auth-to-acc">
                                            <span class="form-check-label">Еще нет аккаунта? <a href="Register.php">Зарегистрироваться</a></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--<script src="../js/app.js"></script>-->

<?php else: ?>
    <p>Привет <?= $_COOKIE['user'] ?>,ты на странице входа<a href="../exit.php">Выход</a></p>
<?php endif; ?>
<script src="../js/RegAuth.js"></script>
</body>
</html>

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/RegAuth/function.php';

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
</head>
<body>
<script src="../lib/jquery-3.6.1.js"></script>

<?php
if (!isset($_COOKIE['user'])):
?>
    <noscript>Включите JS</noscript>

    <form id="form"  style="display:none" name="signup-form">
        <div>
            <div class="form-element">
                <label>
                    <p>Login</p>
                    <input type="text" name="login" title="Должно быть не менее 6"   required/>
                </label>
                <p class="msg_login"></p>
            </div>
            <div class="form-element">
                <label>
                    <p>Email</p>
                    <input type="email" name="email" required/>
                </label>
                <p class="msg_email"></p>
            </div>
            <div class="form-element">
                <label>
                    <p>Password</p>
                    <input type="password" name="password" id="password"    required/>
                </label>
                <p class="msg_password"></p>
            </div>

            <div class="form-element">
                <label>
                    <p>Confirm_password</p>
                    <input type="password" name="Confirm_password" id="confirm_password"   o required/>
                </label>
                <p class="msg_confirm"></p>
            </div>
            <div class="form-element">
                <label>
                    <p>Name</p>
                    <input type="text" name="name"  required/>
                </label>
                <p class="msg_name"></p>
            </div>
            <button class="register-but" type="submit" name="register" id="submit" value="register">Register</button>
            <button onclick="location.href = 'Log.php'">Log in</button>
        </div>
        <p class="msg"></p>
    </form>

    <?php  else: ?>
    <p>Привет <?= $_COOKIE['user'] ?>,ты на странице входа<a href="../exit.php">Выход</a></p>
    <?php endif; ?>
<script type="text/javascript">
    document.getElementById( "form" ).style.display = "block";
</script>
<script src="../lib/jquery-3.6.1.js"></script>
<script src="../js/RegAuth.js"></script>
</body>
</html>

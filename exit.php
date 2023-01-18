<?php
setcookie('user',$user['namedb'],time()-60,"/");
header('Location: /RegAuth/Log.php');
session_destroy();

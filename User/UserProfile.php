<?php
require $_SERVER['DOCUMENT_ROOT'] . '/connectuser.php ';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Пользователь | DreamCinema</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="../css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="../css/global_style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link href="../lib/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../lib/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../lib/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../lib/boxicons/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="../UserHome.php">
                <img src="../images/logo.png" alt="DreamCinema" width="32">
                <span class="align-middle">DreamCinema</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Управление
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="../UserHome.php">
                        <i class="bx bxs-videos align-middle"></i> <span
                                class="align-middle">Кинотека</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="UserFavourite.php">
                        <i class="bi bi-heart-fill align-middle"></i> <span
                                class="align-middle">Любимые</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="UserGenre.php">
                        <i class="align-middle" data-feather="list"></i> <span
                                class="align-middle">Жанры</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="../exit.php">
                        <i class="bx bxs-log-out align-middle"></i> <span class="align-middle">Выйти</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <img src="../images/user.png" class="avatar img-fluid rounded me-1" alt="Charles Hall"/>
                            <span class="text-dark"> <?= $_SESSION['MyName'] ?></span>
                        </a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item"href="UserProfile.php"><i class="align-middle me-1" data-feather="user"></i>
                                Профиль</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i>
                                Настройки</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../exit.php">Выйти</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


        <main class="content">
            <div class="container-fluid p-0">

                <div class="mb-3">
                    <h1 class="h3 mb-3"><strong>Профиль <?= $_SESSION['MyName'] ?></strong></h1>
                </div>
                <div class="row">
                    <!--Profile Info-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Данные профиля</h5>
                            </div>
                            <div class="card-body text-center">
                                <img src="../images/user.png" alt="Christina Mason" class="img-fluid rounded-circle mb-2"
                                     width="128" height="128">
<?php $sql = 'exec ListUserAdmin ?';
$parametr = array($_SESSION['MyName'] );
$stmt = sqlsrv_query($conn, $sql, $parametr);
if ($stmt === false)
{
    die(print_r(sqlsrv_errors(), true));
}
$i = 0;
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
    ?>

                                <h5 class="card-title mb-0"><?=$row['name']?></h5>
                                <div class="text-muted mb-2"><?=$row['status']?></div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <h5 class="h6 card-title">О Вас</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-1"><i class="bx bxs-dizzy"></i> Имя акаунта</li>
                                    <li class="mb-1"><?=$row['login']?></li>
                                    <li class="mb-1"><i class="bx bxs-user"></i> Имя</li>
                                    <li class="mb-1"> <?=$row['name']?></li>
                                    <li class="mb-1"><i class="bx bxs-envelope"></i> Email</li>
                                    <li class="mb-1"> <?=$row['email']?></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile -->
                    <div class="col-md-8 col-xl-9">
                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Изменение данных</h5>
                            </div>
                            <div class="card-body h-100">

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Изменить данные
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                            Изменить пароль
                                        </button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <div class="row">
                                            <div class="col-md-12 col-xl-12">
                                                <div class="card">
                                                    <div class="card-body h-auto">
                                                        <div class="d-flex align-items-start justify-content-center">
                                                            <form class="addFilms form-group" style="width: 90%;">
                                                                <div class="row">
                                                                    <label class="col-sm-12" for="login">
                                                                        <p>Логин</p>
                                                                        <input class="form-control" id="login"
                                                                               type="text" value="<?=$row['login']?>">
                                                                        <p class="msg_login text-danger"></p>
                                                                    </label>
                                                                    <label class="col-sm-12" for="name">
                                                                        <p>Имя</p>
                                                                        <input class="form-control" id="name"
                                                                               type="text" value="<?=$row['name']?>">
                                                                        <p class="msg_name text-danger"></p>
                                                                    </label>
                                                                    <label class="col-sm-12" for="email">
                                                                        <p>Email</p>
                                                                        <input class="form-control" id="email"
                                                                               type="text" value="<?=$row['email']?>">
                                                                        <p class="msg_email text-danger"></p>
                                                                    </label>
                                                                </div>
                                                                <div class="alert alert-success msg-success alert-none text-center"
                                                                     role="alert">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-9">
                                                                        <p class="msg_data_of_end text-danger"></p>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="row">
                                                                    <hr>
                                                                    <button class="btn btn-outline-info btn btn-block changdata"
                                                                            type="submit">Изменить
                                                                    </button>
                                                                    <div class="alert alert-success msg-success alert-none text-center "
                                                                         role="alert">
                                                                    </div>
                                                                    <div class="alert alert-danger msg alert-none text-center"
                                                                         role="alert">
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <!-- Edit password -->
                                        <div class="row">
                                            <div class="col-md-12 col-xl-12">
                                                <div class="card">
                                                    <div class="card-body h-auto">

                                                        <div class="d-flex align-items-start justify-content-center">
                                                            <form class="addFilms form-group" style="width: 90%;">

                                                                <div class="row">
                                                                    <label class="col-sm-12" for="password">
                                                                        <p>Текущий пароль</p>
                                                                        <input class="form-control" id="password"
                                                                               type="text">
                                                                        <p class="msg_password text-danger"></p>
                                                                    </label>
                                                                    <label class="col-sm-12" for="newpassword">
                                                                        <p>Новый пароль</p>
                                                                        <input class="form-control " id="newpassword"
                                                                               type="text">
                                                                        <p class="msg_newpassword text-danger"></p>
                                                                    </label>
                                                                    <label class="col-sm-12" for="renewpassword">
                                                                        <p>Повторите пароль</p>
                                                                        <input class="form-control" id="renewpassword"
                                                                               type="text">
                                                                        <p class="msg_renewpassword text-danger"></p>
                                                                    </label>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-9">
                                                                        <p class="msg_data_of_end text-danger"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <hr>
                                                                    <button class="btn btn-outline-info btn btn-block changpassword"
                                                                            type="submit">Изменить
                                                                    </button>
                                                                    <div class="alert alert-success msg-success alert-none text-center"
                                                                         role="alert">
                                                                    </div>
                                                                    <div class="alert alert-danger msg alert-none text-center"
                                                                         role="alert">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div><!-- End Bordered Tabs -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Write Orders -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Ваши заказы</h5>
                            </div>
                            <div class="card-body h-auto">

                                <div class="d-flex align-items-start justify-content-center">
                                    <table id="tableorder" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <td>Название</td>
                                            <td>Дата</td>
                                            <td>Время</td>
                                            <td>Зал</td>
                                            <td>Номер места</td>
                                            <td>Удалить</td>
                                        </tr>
                                        </thead>
                                        <tbody id="orderbody">
                                        <?php
                                        $parametr=array($_SESSION['MyId']);
                                        $sql='exec ListOrderUser ?';
                                        $stmt = sqlsrv_query( $conn, $sql,$parametr);
                                        if( $stmt === false) {
                                            die( print_r( sqlsrv_errors(), true) );
                                        }

                                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                                            ?>
                                            <tr>
                                                <td><?=$row['name']?></td>
                                                <td><?=$row['dateSession']->format('j/m/Y')?></td>
                                                <td><?=$row['timeSession']->format('H:m')?></td>
                                                <td><?=$row['hallname']?></td>
                                                <td><?=$row['place']?></td>
                                                <td>
                                                    <button class="  btn btn-danger text-center"><i
                                                                class="bi bi-x-square" onclick=dellorder(<?=$row['ID']?>)></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../lib/jquery-3.6.1.js"></script>
<script src="../lib/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../lib/bootstrap/js/popper.min.js"></script>
<script src="../js/ProfileAdmin.js"></script>
<script src="../js/app.js"></script>


</body>

</html>
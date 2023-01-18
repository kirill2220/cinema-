<?php
require $_SERVER['DOCUMENT_ROOT'] . '/connect.php ';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Пользователи | DreamCinema</title>
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
    <!--Datatables-->
    <script src="../lib/datatables/datatables.min.css"></script>
    <link rel="stylesheet" href="../css/datatable.css">
</head>

<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="../AdminHome.php">
                <img src="../images/logo.png" alt="DreamCinema" width="32">
                <span class="align-middle">DreamCinema</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Управление
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="../AdminHome.php">
                        <i class="bx bxs-videos align-middle"></i> <span
                                class="align-middle">Кинотека</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="AdminFavourite.php">
                        <i class="bi bi-heart-fill align-middle"></i> <span
                                class="align-middle">Любимые</span>
                    </a>
                </li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="AdminAllUsers.php">
                        <i class="bx bxs-user-account"></i> <span
                                class="align-middle">Пользователи</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="AdminGenre.php">
                        <i class="align-middle" data-feather="list"></i> <span
                                class="align-middle">Жанры</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="AdminAddFilm.php">
                        <i class="align-middle" data-feather="film"></i>
                        <span class="align-middle">Добавить фильм</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="AdminAddHall.php">
                        <i class="bx bx-table align-middle"></i>
                        <span class="align-middle">Добавить зал</span>
                    </a>
                </li>

               <li class="sidebar-item">
                    <a class="sidebar-link" href="AdminAddSession.php">
                        <i class="bi bi-collection-play-fill align-middle"></i>
                        <span class="align-middle">Добавить сеанс</span>
                    </a>
                </li>
               <li class="sidebar-item">
                    <a class="sidebar-link" href="AdminAllFilm.php">
                        <i class="bi bi-collection-play-fill align-middle"></i>
                        <span class="align-middle">Все фильмы</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="History.php">
                        <i class="bi bi-collection-play-fill align-middle"></i>
                        <span class="align-middle">История действий</span>
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
                            <a class="dropdown-item"href="AdminProfile.php"><i class="align-middle me-1" data-feather="user"></i>
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

                <h1 class="h3 mb-3"><strong>Пользователи</strong></h1>

                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">CinemaDream</h5>
                                                </div>
                                            </div>
                                            <div id="midf" class="mb-0">
                                                <!-- AllUsers DataTable start -->

                                                <table id="data-table" class="table table-striped" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Логин</th>
                                                        <th>Имя</th>
                                                        <th>Email</th>
                                                        <th>Удалить</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="bodyuser">
                                                    <?php
                                                    $sql='exec ListUsersALL';
                                                    $stmt = sqlsrv_query( $conn, $sql);
                                                    if( $stmt === false) {
                                                    die( print_r( sqlsrv_errors(), true) );
                                                    }
                                                    $i=0;
                                                    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                                                    ?>

                                                    <tr>
                                                        <td><?=$row['login']?></td>
                                                        <td><?=$row['name']?></td>
                                                        <td><?=$row['email']?></td>
                                                        <td>
                                                            <button class="btn btn-outline-primary" onclick=DelUSer(<?=$row['ID']?>)>Удалить</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Логин</th>
                                                        <th>Имя</th>
                                                        <th>Email</th>
                                                        <th>Удалить</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>

                                                <!-- AllUsers DataTable end -->
                                            </div>
                                        </div>
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
<script src="../js/app.js"></script>

<!-- Datatables Scripts-->
<script src="../lib/datatables/datatables.min.js"></script>
<script src="../js/allUsers.js"></script>



</body>

</html>
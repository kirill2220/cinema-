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

    <title>Любимые | DreamCinema</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="../css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/global_style.css">
    <link rel="stylesheet" href="../css/cinemaDataTable.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link href="../lib/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../lib/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!--Datatables-->
    <script src="../lib/datatables/datatables.min.css"></script>
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

                <li class="sidebar-item active">
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
                            <img src="../images/user.png" class="avatar img-fluid rounded me-1" alt="Charles Hall"/> <span
                                    class="text-dark"><?= $_SESSION['MyName'] ?></span>
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

                <h1 class="h3 mb-3 text-center"><strong>Любимые</strong></h1>

                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">

                                <div class="container mt-5">

                                    <!--Start of Films block-->
                                    <table id="data-table" class="table table-striped" style="width:100%">
                                        <thead style="display: none">
                                        <tr>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody class="row">
                                        <?php
                                        $parametrs=array($_SESSION['MyId']);
                                        $sql='exec ListFilmFavoriteAll ?';
                                        $stmt = sqlsrv_query( $conn, $sql,$parametrs);
                                        if( $stmt === false) {
                                            die( print_r( sqlsrv_errors(), true) );
                                        }
                                        $i=0;
                                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                                            ?>
                                            <?php

                                            if($i%4===0 ){ /*var_dump($i);*/ ?>
                                                <div class="row">
                                                <?php

                                            }
                                            $show_img=base64_encode($row['img']);
                                            ?>
                                            <tr class="col-md-4">
                                                <td>
                                                    <div class="col-md-12">
                                                        <div class="profile-card">

                                                            <a href="/UserFilm.php?name=<?=$row['name']?>">
                                                                <img src="data:image/jpeg;base64, <?=$show_img ?>"
                                                                     class="img img-responsive">
                                                                <div class="profile-name"><?=$row['name']?></div>
                                                                <div class="profile-username"><?=$row['year']?></div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                            if($i%4==0 && $i!=0){?>
                                                </div><?php
                                            }

                                        }
                                        ?>

                                        </tbody>
                                        <tfoot>
                                    </table>
                                    <!--End of Films block-->


                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


<!-- Datatables Scripts-->
<script src="../lib/datatables/datatables.min.js"></script>
<script src="../js/cinemaDataTable.js"></script>
<script src="../js/app.js"></script>


</body>

</html>
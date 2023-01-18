<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/connect.php ';
$filmname = $_GET['name'];
$arr = [
    'января',
    'февраля',
    'марта',
    'апреля',
    'майя',
    'июня',
    'июля',
    'августа',
    'сентября',
    'октября',
    'ноября',
    'декабря'
];

$sqlll = 'exec CheckSession';
$stmt2 = sqlsrv_query($conn, $sqlll);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Фильм | DreamCinema</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global_style.css">
    <link rel="stylesheet" href="css/film_page.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css">
    <link href="lib/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!--Datatables-->
    <script src="lib/datatables/datatables.min.css"></script>
    <link rel="stylesheet" href="css/datatable.css">
    <script src="lib/jquery-3.6.1.js"></script>

</head>

<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="AdminHome.php">
                <img src="images/logo.png" alt="DreamCinema" width="32">
                <span class="align-middle">DreamCinema</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Управление
                </li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="AdminHome.php">
                        <i class="bx bxs-videos align-middle"></i> <span
                                class="align-middle">Кинотека</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="Admin/AdminFavourite.php">
                        <i class="bi bi-heart-fill align-middle"></i> <span
                                class="align-middle">Любимые</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="Admin/AdminAllUsers.php">
                        <i class="bx bxs-user-account"></i> <span
                                class="align-middle">Пользователи</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="Admin/AdminGenre.php">
                        <i class="align-middle" data-feather="list"></i> <span
                                class="align-middle">Жанры</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="Admin/AdminAddFilm.php">
                        <i class="align-middle" data-feather="film"></i>
                        <span class="align-middle">Добавить фильм</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="Admin/AdminAddHall.php">
                        <i class="bx bx-table align-middle"></i>
                        <span class="align-middle">Добавить зал</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="Admin/AdminAddSession.php">
                        <i class="bi bi-collection-play-fill align-middle"></i>
                        <span class="align-middle">Добавить сеанс</span>
                    </a>
                </li>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="Admin/AdminAllFilm.php">
                        <i class="bi bi-collection-play-fill align-middle"></i>
                        <span class="align-middle">Все фильмы</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="Admin/History.php">
                        <i class="bi bi-collection-play-fill align-middle"></i>
                        <span class="align-middle">История действий</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="exit.php">
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
                            <img src="images/user.png" class="avatar img-fluid rounded me-1" alt="Charles Hall"/> <span
                                    class="text-dark" id="myname"><?= $_SESSION['MyName'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="Admin/AdminProfile.php"><i class="align-middle me-1"
                                                                                      data-feather="user"></i>
                                Профиль</a>
                            <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i>
                                Настройки</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="exit.php">Выйти</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">
                            <div class="row card">
                                <div class="container mt-5">

                                    <!--Start of Films block-->
                                    <?php $sql = 'exec ListFilmAtFilm ?';
                                    $parametr = array($filmname);
                                    $stmt = sqlsrv_query($conn, $sql, $parametr);
                                    if ($stmt === false)
                                    {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                                    $i = 0;
                                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                                    {
                                        //setlocale(LC_ALL, 'rus');
                                        $show_img = base64_encode($row['img']);
$id=$row['ID'];
                                        $datetime = $row['duration'];
                                        $datastart = $row['startRelease'];
                                        $dataend = $row['endRelease'];
                                        $monthstart = $datastart->format('n ') - 1;
                                        $monthend = $dataend->format('n') - 1

                                        ?>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="poster">
                                                    <img src="data:image/jpeg;base64, <?= $show_img ?>"
                                                         alt="Film name">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="info">
                                                    <h1><?= $filmname ?></h1>
                                                    <hr>
                                                    <div class="row favIconContainer">
                                                        <div class="col-sm-8">
                                                            <p>Даты
                                                                показа: <?= $datastart->format('j') . ' ' . $arr[$monthstart]; ?>
                                                                - <?= $dataend->format('j') . ' ' . $arr[$monthend]; ?></p>
                                                        </div>
                                                        <div id="favoritebaton" class="col-sm-4 favBtnBlock">
                                                            <?php $sql = 'exec ListFilmFavorite';
                                    $parametr = array($filmname);
                                    $stmt = sqlsrv_query($conn, $sql, $parametr);
                                    if ($stmt === false)
                                    {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
$a=0;
                                    while ($row1 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                                    {
                                        if($row1 === false){?>

                                            <button onclick="addFavouriteFilm(<?=$id?>)" class="btn favouriteIcon">
                                                Добавить в любимые<i class="bi bi-heart-fill align-middle"></i></button>
                                        <?php
                                        }

                                        if($id==$row1['IDFilm'] && $_SESSION['MyName']==$row1['name']){
                                        $a++;

                                        }


                                    }
                                    if($a==1){?>

                                        <button onclick="removeFavouriteFilm(<?=$id?>)" class="btn favouriteIconTrue">
                                            Удалить из любимых <i class="bi bi-heart-fill align-middle"></i></button>

                                    <?php }else{?>

                                                            <button onclick="addFavouriteFilm(<?=$id?>)" class="btn favouriteIcon">
                                                                Добавить в любимые<i class="bi bi-heart-fill align-middle"></i></button>

                                                            <?php
                                    }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Длительность: <?= $datetime->format(' m ') + $datetime->format(' H ') * 60; ?>
                                                        мин.</p>
                                                    <p>Жанр: <?= $row['name'] ?>.</p>
                                                    <p>Возрастные ограничения: <?= $row['ageLimit'] ?>+</p>
                                                    <p><?=$row['description']?></p>
<?php
$parametrss = array($id);
                                                    $sql5 = 'exec ListCountTicket ?';
                                                    $stmt5 = sqlsrv_query($conn, $sql5,$parametrss);
                                                    if ($stmt5 === false) {
                                                    die(print_r(sqlsrv_errors(), true));
                                                    }

                                                    while ($row5 = sqlsrv_fetch_array($stmt5, SQLSRV_FETCH_ASSOC)) {?>
                                                    <p>На данный фильм куплено <?=$row5['ticket']?> билетов </p>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="row booking-block">
                                        <?php
                                        }
                                        ?>

                                        <h3 class="text-center">Доступные сеансы</h3>
                                        <div class="select-session">
                                            <?php

$param=array($filmname);
                                            $sql2 = 'exec ListSession ?';
                                            $stmt2 = sqlsrv_query($conn, $sql2,$param);
                                            if ($stmt2 === false) {
                                                die(print_r(sqlsrv_errors(), true));
                                            }

                                            while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {


                                                $monthstart=$row2['dateSession']->format('n ') - 1;
                                                $json=[];
                                                $my_array=[];
                                                $params=array($row2['ID']);

                                                $sql4 = 'exec ListTicket ?';
                                                $stmt4 = sqlsrv_query( $conn, $sql4,$params );
                                                if( $stmt4 === false) {
                                                    die( print_r( sqlsrv_errors(), true) );
                                                }
$mass=[];
                                                while( $row4 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_ASSOC) ) {

                                            array_push($mass,$row4['place']);
                                                    ?>


                                                        <?php
                                                        //var_dump($mass);
                                                }
                                                $_SESSION['idsession']=$row2['ID'];
                                                ?>



                                            <button class="session-data" onclick="writeHole(<?=$row2['count_rows']?>,<?=$row2['count_place']?>, <?= json_encode($mass);?>,<?=$row2['cost_normal']?>,<?=$row2['cost_vip']?>,<?=$row2['ID']?>,<?=$row2['idhall']?>)">
                                                <p class="session-day"><?=$row2['dateSession']->format('j')?></p>
                                                <p class="session-month"><?= $arr[$monthstart]; ?></p>
                                                <p class="session-time"><?=$row2['timeSession']->format('H:m')?></p>
                                            </button>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="hole">
                                            <h2 class="hole-title"></h2>
                                            <div class="container hole-block"></div>
                                        </div>
                                        <div class="selected-seats row">
                                            <!--  Example  -->
                                            <!--<div class="selected-seat">
                                                <p>Ряд: 1, Место: 27</p>
                                                <p>Тип места: Стандарт</p>
                                                <p>Стоимость: 7,00 р.</p>
                                            </div>-->
                                        </div>
                                        <div class="total-seats row">
                                        </div>
                                        <!--End of Films block-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-xxl-12 d-flex">
                        <div class="w-100">
                            <div class="row card">
                                <div id="all-users-block" class="container mt-5">
                                    <h3 class="text-center">Пользователи</h3>
                                    <table id="data-table " class="table table-striped" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Имя</th>
                                            <th>Место</th>
                                            <th>Удалить</th>
                                        </tr>
                                        </thead>
                                        <tbody id="bodyusers">


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Имя</th>
                                            <th>Место</th>
                                            <th>Удалить</th>
                                        </tr>
                                        </tfoot>
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

<script src="js/app.js"></script>

<!-- Datatables Scripts-->
<script src="lib/datatables/datatables.min.js"></script>
<script src="js/writeHole.js"></script>
<script src="js/Film.js"></script>

</body>

</html>
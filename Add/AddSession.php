<?php
require$_SERVER['DOCUMENT_ROOT'].'/connect.php ';
session_start();
$i=0;

if(isset($_POST['date'])) {
    $date = $_POST['date'];
    $hole = $_POST['hole'];
    $film = $_POST['film'];
    $time = $_POST['time'];


     $HourNow = date("H",strtotime($time))*60;
    $MinutNow = date("i",strtotime($time))*1;



    $error_fields=[];
    if($date===''){
        $error_fields[]='date';
    }
    if($hole===''){
        $error_fields[]='hole';
    }
    if($film===''){
        $error_fields[]='film';
    }

    if($time===''){
        $error_fields[]='time';
    }


    if(!empty($error_fields)){
        $response=[
            "status"=>false,
            "type"=>1,
            "message"=>"Заполните все поля",
            "fields"=>$error_fields
        ];
        echo json_encode($response);
        die();
        $i++;
    }


    $hole=(int)$hole;
    $film=(int)$film;
    $json=[];
    $my_array=[];

    $params=array($film);
    $sql = 'exec CheckDurationFilm ?';
    $stmt = sqlsrv_query( $conn, $sql,$params );
    if( $stmt === false) {

        die( print_r( sqlsrv_errors(), true) );

    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

        $time1=$row['duration']->format(' m ') + $row['duration']->format(' H ') * 60;

    }


$timeStart=$MinutNow+$HourNow;







    $params=array($hole,$date);

    $sql = 'exec CheckFreeHall ?,?';
    $stmt = sqlsrv_query( $conn, $sql,$params );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );

    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $timeOtherSession=$row['duration']->format(' m ') + $row['duration']->format(' H ') * 60;
        $timeStartOtherSession=$row['timeSession']->format(' i ') + $row['timeSession']->format(' H ') * 60;
        if($time1+$timeStart>=$timeStartOtherSession && $timeStart<=$timeOtherSession+$timeStartOtherSession ){

            $response=[
                "status"=>false,
                "type"=>2,
                "message"=>"В данное время в данном кинотеатре идет фильм",
            ];
            echo json_encode($response);
            die();
            $i++;
        }

    }

$params=array($film);
    $sql2 = 'exec ListCheckSes ?';
    $stmt2 = sqlsrv_query( $conn, $sql2,$params );
    if( $stmt2 === false) {
        die( print_r( sqlsrv_errors(), true) );

    }

    while( $row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
        $date1 = new DateTime($date);
        if($date1>$row2['endRelease'] ){

            $response=[
                "status"=>false,
                "type"=>3,
                "message"=>"Прокат фильма уже закончен",
            ];
            echo json_encode($response);
            die();
            $i++;
        }

        if($date1<$row2['startRelease'] ){

            $response=[
                "status"=>false,
                "type"=>3,
                "message"=>"Прокат фильма еще не начался",
            ];
            echo json_encode($response);
            die();
            $i++;
        }

    }


    if($i==0){

        $params = array($date,$hole,$film,$time);

        $sql='exec InsertSession ?,?,?,?';


        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );

        }

        $response=[
            "status"=>true,
            "message"=>"Сеанс  успешно добавлен",
        ];
        echo json_encode($response);
    }




}
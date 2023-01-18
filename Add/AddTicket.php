<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/connect.php ';

$i = 0;

if (isset($_POST['IdHall'])) {


    $IdHall = $_POST['IdHall'];
    $IdSession = $_POST['IdSession'];
    $mas = $_POST['mas'];
    for ($a = 0; $a <= count($mas); $a++) {
        $params = array($mas[$a], $IdHall, $IdSession, $_SESSION['MyId']);
        var_dump($params);
        $sql = 'exec insertTicket ?,?,?,?';
        $stmt = sqlsrv_query($conn, $sql,$params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
}

if (isset($_POST['IdSession2'])) {



    $IdSession = $_POST['IdSession2'];
    $json=[];
    $my_array=[];
        $parametr = array( $IdSession);

    $sql = 'exec ListUserAtFilm ?';
    $stmt = sqlsrv_query( $conn, $sql,$parametr);
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $my_array=array(
            'place'=> $row['place'],
            'name'=> $row['name'],
            'login'=>$row['login'],
            'id'=>$row['ID'],
            'sessionid'=>$row['sessionid']
        );
        array_push($json,$my_array);
    }
    $response=[
        "status"=>true,
        "mas"=>$json,
    ];
    echo json_encode($response);
   }

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $obj = [];
    $my_array = [];
    $params = array($id);
    $sql = 'exec DellOrder ?';
    $stmt = sqlsrv_query($conn, $sql, $params);
    $IdSession = $_POST['sessionid'];
    $json=[];
    $my_array=[];
    $parametr = array( $IdSession);

    $sql = 'exec ListUserAtFilm ?';
    $stmt = sqlsrv_query( $conn, $sql,$parametr);
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $my_array=array(
            'place'=> $row['place'],
            'name'=> $row['name'],
            'login'=>$row['login'],
            'id'=>$row['ID'],
            'sessionid'=>$row['sessionid']
        );
        array_push($json,$my_array);
    }
    $response=[
        "status"=>true,
        "mas"=>$json,
    ];
    echo json_encode($response);
}



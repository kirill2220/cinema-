<?php
require$_SERVER['DOCUMENT_ROOT'].'/connect.php ';
session_start();
$i=0;

if(isset($_POST['name'])) {
    $name = $_POST['name'];
    $coastvip = $_POST['coastvip'];
    $coastnorm = $_POST['coastnorm'];
    $seats = $_POST['seats'];
    $rows = $_POST['rows'];

    function validation($elem)
    {
        if($elem<=0){
            $result=true;
        }else{
            $result=false;
        }
        return $result;
    }

    $error_fields=[];
    if($name===''){
        $error_fields[]='name';
    }
    if($coastvip===''){
        $error_fields[]='coastvip';
    }
    if($coastnorm===''){
        $error_fields[]='coastnorm';
    }

    if($seats===''){
        $error_fields[]='seats';
    }

    if($rows===''){
        $error_fields[]='rows';
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
if(validation($seats) || $seats>12){
    $response=[
        "status"=>false,
        "type"=>2,
        "message"=>"Количество мест в ряду не может быть меньше или равно 0 и больще 12",
    ];
    echo json_encode($response);
    die();
    $i++;
}
    if(validation($coastnorm)){
        $response=[
            "status"=>false,
            "type"=>3,
            "message"=>"Стоимость обычных билетов не может быть меньше или равно 0",
        ];
        echo json_encode($response);
        die();
        $i++;
    }

    if(validation($coastvip)){
        $response=[
            "status"=>false,
            "type"=>4,
            "message"=>"Стоимость вип билетов не может быть меньше или равно 0",
        ];
        echo json_encode($response);
        die();
        $i++;
    }

    if(validation($rows)){
        $response=[
            "status"=>false,
            "type"=>6,
            "message"=>"Количество рядов не может быть меньше или равно 0",
        ];
        echo json_encode($response);
        die();
        $i++;
    }


    $sql = 'exec ListHallName';
    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        if ($name==$row['name'] ){

            $response=[
                "status"=>false,
                "type"=>5,
                "message"=>"Зал с таким название уже существует",
            ];
            echo json_encode($response);
            die();
            $i++;
        }
    }



    if($i==0){

        $params = array($name,$coastvip,$coastnorm,$seats,$rows);
        $sql='exec InsertHall ?,?,?,?,?';


        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );

        }

        $response=[
            "status"=>true,
            "message"=>"Зал  успешно добавлен",
        ];
        echo json_encode($response);
    }




}


if(isset($_POST['flag'])) {

        $sql='use master exec BackupDB ';


        $stmt = sqlsrv_query( $conn, $sql);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );

        }

        $response=[
            "status"=>true,
            "message"=>"Бэкап был создан ",
        ];
        echo json_encode($response);
}
if(isset($_POST['flag1'])) {

    $sql='exec ImportHalltromXML ';


    $stmt = sqlsrv_query( $conn, $sql);

    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );

    }

    $response=[
        "status"=>true,
        "message"=>"извлечено ",
    ];
    echo json_encode($response);
}
if(isset($_POST['flag2'])) {

    $sql='exec ExportHallToXML ';


    $stmt = sqlsrv_query( $conn, $sql);

    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );

    }

    $response=[
        "status"=>true,
        "message"=>"Добавлено ",
    ];
    echo json_encode($response);
}
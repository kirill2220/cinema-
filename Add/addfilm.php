<?php
require$_SERVER['DOCUMENT_ROOT'].'/connect.php ';
session_start();
$i=0;

if(isset($_POST['name'])) {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $duration = $_POST['duration'];
    $age = $_POST['age'];
    $date_of_start = $_POST['date_of_start'];
    $date_of_end = $_POST['date_of_end'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];


    $error_fields=[];
    if($name===''){
        $error_fields[]='name';
    }
    if($year===''){
        $error_fields[]='year';
    }
    if($duration===''){
        $error_fields[]='duration';
    }
    if($age===''){
        $error_fields[]='age';
    }
    if($date_of_start===''){
        $error_fields[]='date_of_start';
    }
    if($date_of_end===''){
        $error_fields[]='date_of_end';
    }
    if($genre===''){
        $error_fields[]='genre';
    }
    if($description===''){
        $error_fields[]='description';
    }

    if(isset($_FILES['poster']['tmp_name'])){
        $poster=file_get_contents($_FILES['poster']['tmp_name']);
    }else{
        $error_fields[]='poster';
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
    $year=(int)$year;
    $age=(int)$age;

    $sql = 'exec ListFilmNamedate';
    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );

    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        if ($name==$row['name'] && $year==$row['year'] ){

            $response=[
                "status"=>false,
                "type"=>5,
                "message"=>"Фильм с таким название уже существует в данном году ",
            ];
            echo json_encode($response);
            die();
            $i++;
        }
    }


if ($year<1895 ){

    $response=[
        "status"=>false,
        "type"=>2,
        "message"=>"Кино изобрели в 1895 году",
    ];
    echo json_encode($response);
    die();
    $i++;
}
if($age> 21 || $age< 0  ){
    $response=[
        "status"=>false,
        "type"=>3,
        "message"=>"Ограничения могут быть от 0 до 21",
    ];
    echo json_encode($response);
    die();
    $i++;
}

if($date_of_start>=$date_of_end){
    $response=[
        "status"=>false,
        "type"=>4,
        "message"=>"Дата начала проката не может быть позже или равен даты оканчания",
    ];
    echo json_encode($response);
    die();
    $i++;
}


    if($i==0){

        $params = array($name,$year,$duration,$date_of_start,$date_of_end,$description,$age,$genre,array($poster,
            SQLSRV_PARAM_IN,
            SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY),
            SQLSRV_SQLTYPE_VARBINARY('max')));
        $sql='exec InsertFilm ?,?,?,?,?,?,?,?,?';


        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );

        }

        $response=[
            "status"=>true,
            "message"=>"Фильм  успешно добавлен",
        ];
        echo json_encode($response);
    }




}
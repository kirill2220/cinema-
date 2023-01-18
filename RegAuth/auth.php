<?php
include $_SERVER['DOCUMENT_ROOT'].'/connect.php';
session_start();
if(isset($_POST['login'])) {
    $i = 0;
    $json=[];
    $my_array=[];
    $sql = 'exec ListUsersPasswordLogin';
    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $my_array=array(
            'passworddb'=> $row['password'],
            'logindb'=>$row['login'],
            'iddb'=>$row['ID'],
            'namedb'=>$row['name'],
            'statusdb'=>$row['status']
        );
        array_push($json,$my_array);
    }



    $login = preg_replace('/\s+/', '', $_POST['login']);
    $password=preg_replace('/\s+/', '', $_POST['password']);
    $error_fields=[];
    if($password===''){
        $error_fields[]='password';
    }
    if($login===''){
        $error_fields[]='login';
    }
if(!empty($error_fields)){
    $response=[
        "status"=>false,
        "type"=>2,
        "message"=>"Заполните все поля",
         "fields"=>$error_fields
    ];
    echo json_encode($response);
    die();
}

    foreach ($json as $msg) {
        if ($login == $msg['logindb'] && $password == $msg['passworddb']) {
            $user = $msg;
            $_SESSION['user'] = [
                "name" => $user['namedb']
            ];

            setcookie('user', $user['namedb'], time() + 10, "/");
            $_SESSION['MyName']=$user['namedb'];
            $_SESSION['MyId']=$user['iddb'];
            $response= [
                "status"=> true,
                "path"=>$user['statusdb'],
            ];
            $i++;
            echo json_encode($response);
        }
    }
    if ($i == 0) {
        $response =[
            "status"=> false,
            "type"=>1,
            "message"=>'Неверный логин или пароль'
        ];
        echo json_encode($response);
    }
}
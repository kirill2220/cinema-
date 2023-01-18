<?php
require$_SERVER['DOCUMENT_ROOT'].'/connect.php ';
session_start();
if (isset($_POST['password'])) {
    $i=0;
    $password = $_POST['password'];
    $renewpassword = $_POST['renewpassword'];
    $newpassword = $_POST['newpassword'];


    $error_fields = [];
    if ($password === '') {
        $error_fields[] = 'password';
    }
    if ($renewpassword === '') {
        $error_fields[] = 'renewpassword';
    }
    if ($newpassword === '') {
        $error_fields[] = 'newpassword';
    }


    if (!empty($error_fields)) {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Заполните все поля",
            "fields" => $error_fields
        ];
        echo json_encode($response);
        die();
        $i++;
    }







    $parametrs = array($_SESSION['MyName']);

    $sql = 'exec ListChangePassword ?';
    $stmt = sqlsrv_query( $conn, $sql,$parametrs );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

        if ($password === $row['password'] ) {

        }else{
            $response = [
                "status" => false,
                "type" => 2,
                "message" => "Неверный пароль",
            ];
            $i++;
            echo json_encode($response);
            die();
        }
    }









    if (strlen( $newpassword)>=6   ){}
    else{
        $response=[
            "status"=>false,
            "type"=>3,
            "message"=>"Длинна пароля должна быть не менее 6 символов и включать в себя цифры и буквы латинского алфаввита".$newpassword,
        ];
        $i++;
        echo json_encode($response);
        die();
    }


    if($newpassword!=$renewpassword ){
        $response=[
            "status"=>false,
            "type"=>4,
            "message"=>"Не совпадают пароли",
        ];
        $i++;
        echo json_encode($response);
        die();
    }


    if ($i == 0) {


        $params = array($newpassword, $password, $_SESSION['MyName']);
        $sql = 'exec ChangePassword ?,?,? ';
        $stmt1 = sqlsrv_query($conn, $sql, $params);
        if ($stmt1 === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $response = [
            "status" => true,
            "message" => 'Пароль  был сменен'
        ];
        echo json_encode($response);
    }


}
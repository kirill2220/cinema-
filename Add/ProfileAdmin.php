<?php
require$_SERVER['DOCUMENT_ROOT'].'/connect.php ';
session_start();
$i=0;

if(isset($_POST['name'])) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];



    $error_fields=[];
    if($name===''){
        $error_fields[]='name';
    }
    if($login===''){
        $error_fields[]='login';
    }
    if($email===''){
        $error_fields[]='email';
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


    $json=[];
    $my_array=[];
    $sql = 'exec ListUsersEmailLogin';
    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $my_array=array(
            'emaildb'=> $row['email'],
            'namedb'=> $row['name'],
            'logindb'=>$row['login']
        );
        array_push($json,$my_array);
    }
    $namecheck=(string)$_SESSION['MyName'];
    foreach ($json as $pas){
        $pas['namedb']=(string)$pas['namedb'];;
        if($pas["logindb"]==$login && $namecheck!=$pas['namedb']){
            $response=[
                "status"=>false,
                "type"=>2,
                "message"=>"Такой login уже существует!",
            ];
            echo json_encode($response);
            die();
            $i++;
        }


        if($pas["emaildb"]==$email && $namecheck!=$pas['namedb']){

            $response=[
                "status"=>false,
                "type"=>3,
                "message"=>"Такой email уже существует!".$pas['namedb'].$namecheck,
            ];
            echo json_encode($response);
            die();
            $i++;
        }

        if($pas['namedb']==$name && $namecheck!=$pas['namedb']){

            $response=[
                "status"=>false,
                "type"=>4,
                "message"=>"Такое имя уже существует!",
            ];
            echo json_encode($response);
            die();
            $i++;
        }
    }


    if (strlen( $login)>=6){}
    else{
        $response=[
            "status"=>false,
            "type"=>2,
            "message"=>"длинна логина не менее 6 символов",
        ];
        $i++;
        echo json_encode($response);
        die();
    }
    if(strlen( $name) >=1 && strlen( $name) <=10 && preg_match('/[A-Za-z]/',$name) ){}
    else{
        $response=[
            "status"=>false,
            "type"=>4,
            "message"=>"Длинна имени должна быть не менее 1 и не более 10  символа и включает в себя буквы латинского алфаввита",
        ];
        $i++;
        echo json_encode($response);
        die();
    }
    if(preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)){}
    else{
        $response=[
            "status"=>false,
            "type"=>3,
            "message"=>"Неверный формат email",
        ];
        $i++;
        echo json_encode($response);
        die();
    }
    if($i==0){

        $params = array($name,$login,$email,$_SESSION['MyName']);
        $sql='exec ChangeUserInfo ?,?,?,?';


        $stmt = sqlsrv_query( $conn, $sql, $params);

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );

        }

        $response=[
            "status"=>true,
            "message"=>"Данные изменения успешно добавлены",
        ];
        $_SESSION['MyName']=$name;
        echo json_encode($response);
    }

}

if(isset($_POST['id'])) {
    $id=$_POST['id'];
    $obj=[];
    $my_array=[];
    $params = array($id);
    $sql = 'exec DellOrder ?';
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false)
    {
        die(print_r(sqlsrv_errors(), true));
    }else {
        $parametr=array($_SESSION['MyId']);
        $sql='exec ListOrderUser ?';
        $stmt1 = sqlsrv_query($conn, $sql,$parametr);
        while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
            $my_array = array(
                'dateSession' => $row['dateSession'],
                'name' => $row['name'],
                'timeSession' => $row['timeSession'],
                'id' => $row['ID'],
                'hallname' => $row['hallname'],
                'place' => $row['place'],
            );

            array_push($obj, $my_array);

        }



        $response = [
            "mas" => $obj,
            "status"=>true
        ];
        echo json_encode($response);
    }
}



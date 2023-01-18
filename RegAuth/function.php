<?php
require $_SERVER['DOCUMENT_ROOT'].'/connect.php ';

session_start();
$i=0;

if(isset($_POST['login'])) {
    $login=preg_replace('/\s+/', '', $_POST['login']);
    $password=preg_replace('/\s+/', '', $_POST['password']);
    $Confirm_password=preg_replace('/\s+/', '', $_POST['Confirm_password']);
    $name=preg_replace('/\s+/', '', $_POST['name']);
    $email=preg_replace('/\s+/', '', $_POST['email']);




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


    //$_SESSION['a']=$json['logindb'];
    $error_fields=[];
    if($password===''){
        $error_fields[]='password';
    }
    if($login===''){
        $error_fields[]='login';
    }
    if($Confirm_password===''){
        $error_fields[]='Confirm_password';
    }
    if($name===''){
        $error_fields[]='name';
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


   foreach ($json as $pas){
        if($pas["logindb"]==$login){

            $response=[
                "status"=>false,
                "type"=>2,
                "message"=>"Такой login уже существует!",
            ];
            echo json_encode($response);
            die();
            $i++;
        }


        if($pas["emaildb"]==$email){

            $response=[
                "status"=>false,
                "type"=>3,
                "message"=>"Такой email уже существует!",
            ];
            echo json_encode($response);
            die();
            $i++;
        }

       if($pas['namedb']==$name){

           $response=[
               "status"=>false,
               "type"=>6,
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
       if (strlen( $password)>=6  && preg_match('/[0-9]/',$password) && preg_match('/[A-Za-z]/',$password) ){}
       else{
           $response=[
               "status"=>false,
               "type"=>4,
               "message"=>"Длинна пароля должна быть не менее 6 символов и включать в себя цифры и буквы латинского алфаввита",
           ];
           $i++;
           echo json_encode($response);
           die();
       }
       if(strlen( $name) >=1 && strlen( $name) <=10 && preg_match('/[A-Za-z]/',$name) ){}
       else{
           $response=[
               "status"=>false,
               "type"=>6,
               "message"=>"Длинна имени должна быть не менее 1 и не более 10  символа и включает в себя буквы латинского алфаввита",
           ];
           $i++;
           echo json_encode($response);
           die();
       }
       if($Confirm_password!=$password ){
           $response=[
               "status"=>false,
               "type"=>5,
               "message"=>"Не совпадают пароли",
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
              $arr = array(
                  'login'     => $login,
                  'email'    => $email,
                  'password'     => $password,
                  'name'    => $name
              );

              $params = array($arr['login'],$arr['password']);
$sql='exec InsertUsers ?, ?';
              $stmt = sqlsrv_query( $conn, $sql, $params);
              if( $stmt === false) {
                  die( print_r( sqlsrv_errors(), true) );
              }
              $params = array($arr['login'],$arr['password'],$arr['name'],$arr['email']);
              $sql='exec InsertData ?, ?,? ,? ';
              $stmt = sqlsrv_query( $conn, $sql, $params);
              if( $stmt === false) {
                  die( print_r( sqlsrv_errors(), true) );
              }

              $response=[
                  "status"=>true,
                  "message"=>"Пользователь успешно зарегистрирован",
              ];
              echo json_encode($response);
          }

}

<?php
require $_SERVER['DOCUMENT_ROOT'].'/connect.php';
session_start();
if(isset($_POST['idd'])) {
    $idd=$_POST['idd'];

    $obj=[];
    $my_array=[];
    $params = array($idd,$_SESSION['MyId']);

    if($_POST['status']=='add'){
        $sql = 'exec InsertFavorite ?,?';
    }else{
        $sql = 'exec DeleteFavorite ?,?';
    }
    $stmt = sqlsrv_query($conn, $sql, $params);


    $sql = 'exec ListFilmFavorite';
    $stmt1 = sqlsrv_query($conn, $sql);
    while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
        $my_array=array(

            'IDFilm'=>$row['IDFilm'],
            'name'=> $row['name'],

        );
        array_push($obj,$my_array);
    }




    $response=[
        "mas"=>$obj,
        "status"=>true,

    ];
    echo json_encode($response);

}
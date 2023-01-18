<?php
require$_SERVER['DOCUMENT_ROOT'].'/connect.php ';
session_start();
$i=0;

if(isset($_POST['search'])) {
    $search=$_POST['search'];
$params = array($search);

    $json=[];
    $my_array=[];
    $sql='exec Search ?';
    $stmt = sqlsrv_query( $conn, $sql,$params );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $my_array=array(
            'name'=> $row['name'],
            'year'=> $row['year'],
            'img'=>base64_encode($row['img']),
        );
        array_push($json,$my_array);
    }
$response=[
    "status"=>true,
    "mas"=>$json,
];
echo json_encode($response);
}

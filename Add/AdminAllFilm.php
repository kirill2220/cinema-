<?php
require $_SERVER['DOCUMENT_ROOT'].'/connect.php';
session_start();
if(isset($_POST['id'])) {
    $id=$_POST['id'];
    $obj=[];
    $my_array=[];
    $params = array($id);
    $sql = 'exec DellFilm ?';
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false)
    {
        die(print_r(sqlsrv_errors(), true));
    }else {
        $sql = 'exec ListFilm';
        $stmt1 = sqlsrv_query($conn, $sql);
        while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
            $my_array = array(

                'name' => $row['name'],
                'year' => $row['year'],
                'id' => $row['ID']
            );
            $my_array1 = array();
            array_push($obj, $my_array);

        }



        $response = [
            "info" => $obj,
            "status"=>true
        ];
        echo json_encode($response);
    }
}
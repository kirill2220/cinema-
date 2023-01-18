
<?php
require$_SERVER['DOCUMENT_ROOT'].'/connect.php ';
session_start();
$a=5;
$b=6;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script>
    let mass=[];
</script>

<script>
    mass.push(<?=$a;?>);
    mass.push(<?=$b;?>);
    alert(mass);
</script>

</body>
</html>
<?php
$sql='exec ExportHallToXML ';


$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );

}

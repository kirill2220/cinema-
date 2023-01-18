
<?php

$server = $_SERVER['SERVER_ADDR'];
$username = 'root';
$password = 'root';
$dbname = 'img';
$charset = 'utf8';

$connection = new mysqli($server, $username, $password, $dbname);

if($connection->connect_error){
    die("Ошибка соединения".$connection->connect_error);
}

if(!$connection->set_charset($charset)){
    echo "Ошибка установки кодировки UTF8";
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Загрузка картинки в БД</title>
</head>

<body>
<form action="test2.php" method="post" enctype="multipart/form-data">
    <p>Загрузить картику</p>
    <input type="file" name="img_upload"><input type="submit" name="upload" value="Загрузить">
    <?php

    if(isset($_POST['upload'])){
        $img_type = substr($_FILES['img_upload']['type'], 0, 5);
        $img_size = 2*1024*1024;
        if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size){
            $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
            $connection->query("INSERT INTO images (img) VALUES ('$img')");
        }
    }
    ?>
</form>
<?php

$query = $connection->query("SELECT * FROM images ORDER BY id DESC");
while($row = $query->fetch_assoc()){
    $show_img = base64_encode($row['img']);
    var_dump($show_img);?>
    <img src="data:image/jpeg;base64, <?=$show_img ?>" alt="" width="100px" height="100px">
<?php } ?>
</body>
</html>
date('H:i:s',$row['duration'])
/*$query = "select img from ing";
$result = odbc_exec($conn, $query) or die("Couldn't execute query!");
$json=[];
$my_array=[];

while(odbc_fetch_row($result)){

$img=odbc_result($result,'img');

$my_array=array(
'img'=> $img

);
array_push($json,$my_array);
}*/
/*foreach ($json as $msg) {
var_dump(base64_encode($msg['img']));
}*/

// $img = addslashes(file_get_contents($_FILES['poster']['tmp_name']));
//$img1 = addslashes(file_get_contents("C:\Users\Kirill\Downloads\Video\imagine-dragons-x-jid-enemy_409720.mp4"));
//var_dump($poster);
//var_dump($_FILES['photo']['tmp_name']);
//$query = "insert into ing(img) values('$img')";
//var_dump($trailer.'</br>');
//var_dump($_FILES['poster']['tmp_name'].'</br>');
//var_dump($img);
// $query = "select img from ing";
//$result = odbc_exec($conn, $query) or die("Couldn't execute query!");


$sql = "exec InsertImg ?";
$params = array($img);
$_SESSION['a']=$sql;
$stmt = sqlsrv_query( $conn, $sql,$params);
if( $stmt === false ) {
die( print_r( sqlsrv_errors(), true));
}
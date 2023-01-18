<?php
$serverName = "Kirill"; //serverName\instanceName
$connectionInfo = array( "Database"=>"kursach", "UID"=>"Klient", "PWD"=>"Barabull17",'CharacterSet'=>'UTF-8');
$conn = sqlsrv_connect( "Kirill", $connectionInfo);

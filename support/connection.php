<?php 

// Server=MONKEYPC\MARCODATABASE;Database=JandAFinal;Trusted_Connection=True;"


$server_name =  "MONKEYPC\\MARCODATABASE";

// $serverOption = array("Database" => "JandAFinal", "UID" =>"", "PWD" => "");
$databasename = "JandAFinal";

// echo phpinfo();

// $conn = sqlsrv_connect("localhost","");


try{
    $conn = new PDO("sqlsrv:Server=".$server_name.";Database=JandAFinal", "", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}


// $conn = mssql_connect("localhost","","") or die("Tang ina");
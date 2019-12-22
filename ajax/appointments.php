<?php 

require_once "../support/ja_config.php";

$test = $conn->query("SELECT AppointmentID, CustomerName, AppointmentDate FROM tblAppointment WHERE AppointmentStatus = 'Pending'")->fetchAll(PDO::FETCH_ASSOC);


$mainArr = [];


foreach($test as $key => $val){
    $newObj = new stdClass();
    $newObj->id = ''.$val["AppointmentID"];
    $newObj->title = $val["CustomerName"];
    $newObj->start = $val["AppointmentDate"];
    $newObj->end = $val["AppointmentDate"];
    array_push($mainArr, $newObj);
}


// print_r($mainArr);


echo json_encode($mainArr);
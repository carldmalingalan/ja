<?php 

// require_once "class.myPDO.php";

$conn = new PDO("sqlsrv:Server=MONKEYPC\\MARCODATABASE;Database=JandAFinal","","");

function print_pre($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function getStringMonth($month){
    switch(intval($month)){
    case 1:
        return "January";
    case 2:
        return "February";
    case 3:
        return "March";
    case 4:
        return "April";
    case 5:
        return "May";
    case 6:
        return "June";
    case 7:
        return "July";
    case 8:
        return "August";
    case 9:
        return "September";
    case 10:
        return "October";
    case 11:
        return "November";
    case 12:
        return "December";
        
    }
}
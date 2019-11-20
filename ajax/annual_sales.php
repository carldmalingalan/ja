<?php 

$mainArr = array();
$names = array("Hair","Face","Body","Nail","Total");
foreach($names as $index => $elem){
    $jsonObj = new stdClass();
    $jsonObj->name = $elem;
    $jsonObj->showInLegend = true;
    $jsonObj->visible = $elem === "Total" || $elem === "Nail" ? true : false;
    $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nail" ? "" : null;;
    // $jsonObj->visible = true;
    $jsonObj->type = "spline";
    $jsonObj->xValueFormatString = "YYYY";
    $jsonObj->yValueFormatString = "₱#,###,###.##";
    $arr = array();
    $year = array(2019,2018,2017);

    foreach($year as $key => $val){
        $tempObj = new stdClass();
        $tempObj->x = [intval($val),12,1];
        $tempObj->y = mt_rand(100000,1000000);
        array_push($arr,$tempObj);
    }
    
    $jsonObj->dataPoints = $arr;
    array_push($mainArr,$jsonObj);
}


echo json_encode($mainArr);
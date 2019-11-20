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
    $jsonObj->xValueFormatString = "Week D";
    $jsonObj->yValueFormatString = "₱#,###,###.##";
    $arr = array();
    foreach(range(1,4) as $key => $val){
        $tempObj = new stdClass();
        $tempObj->x = [intval(date("Y")),intval(date("m"))-1,$val];
        $tempObj->y = mt_rand(10000,100000);
        array_push($arr,$tempObj);
    }
    $jsonObj->dataPoints = $arr;
    array_push($mainArr,$jsonObj);
}


echo json_encode($mainArr);
<?php 
$mainArr = array();
$names = array("Hair","Face","Body","Nail","Total");
$employees = array("Carl Dennis Alingalan", "Marco De Guzman", "Aila Mae Espinas", "Joel Jude Castillo", "Queenie Roes Sebucao", "Piolo Pascual", "Liza Soberano", "Kuya Jobert", "Jose Manalo");
foreach($names as $index => $elem){
    $jsonObj = new stdClass();
    $jsonObj->name = $elem;
    $jsonObj->showInLegend = true;
    $jsonObj->visible = $elem === "Total" || $elem === "Nail" ? true : false;
    $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nail" ? "" : null;;
    // $jsonObj->visible = true;
    $jsonObj->type = "bar";
    $jsonObj->xValueFormatString = "";
    $jsonObj->yValueFormatString = "";
    $arr = array();
    foreach($employees as $key => $val){
        $tempObj = new stdClass();
        $tempObj->label = $val;
        $tempObj->y = mt_rand(50,500);
        array_push($arr,$tempObj);
    }
    $jsonObj->dataPoints = $arr;
    array_push($mainArr,$jsonObj);
}


echo json_encode($mainArr);


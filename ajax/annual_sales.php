<?php 

require_once "../support/ja_config.php";

$test = $conn->query("select Year,Sum(Price) as Income,ServiceType from (
    select TransactionNumber,YEAR([date/time]) as [Year],ServiceType, SUM(ServicePrice) as Price  from dashboard_View
    group by TransactionNumber,YEAR([date/time]),ServiceType) b
    group by ServiceType,Year")->fetchAll(PDO::FETCH_ASSOC);


$initData = array();
$total = 0;

// print_r($test);
// die;
foreach($test as $key => $val){
    $initData["{$val['Year']}"][$val["ServiceType"]] = $val["Income"];
    $total += floatval($val["Income"]);

    if($val === end($test)){
        $initData["{$val['Year']}"]["Total"] = $total;
    }
}
$totalCount = sizeof($initData);

// $initData["Total"] = $total;
// print_r($initData);
// die; 

$mainArr = array();
$names = array("Hair","Face","Body","Nails","Total");
foreach($names as $index => $elem){
    $jsonObj = new stdClass();
    $jsonObj->name = $elem;
    $jsonObj->showInLegend = true;
    $jsonObj->visible = $elem === "Total" || $elem === "Nails" ? true : false;
    $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nails" ? "" : null;

    $jsonObj->type = $totalCount > 1 ? "splice" : "bar";
    $jsonObj->xValueFormatString = "YYYY";
    $jsonObj->yValueFormatString = "₱#,###,###.##";
    $arr = array();
    foreach($initData as $key => $val){
        $tempObj = new stdClass();
        $tempObj->x = [$key,12,1];
        $tempObj->y = array_key_exists($elem,$val) ? floatval($val[$elem]) : 0;
        array_push($arr,$tempObj);
    }
    
    $jsonObj->dataPoints = $arr;
    array_push($mainArr,$jsonObj);
}


// Place Holder
// $mainArr = array();
// $names = array("Hair","Face","Body","Nail","Total");
// foreach($names as $index => $elem){
//     $jsonObj = new stdClass();
//     $jsonObj->name = $elem;
//     $jsonObj->showInLegend = true;
//     $jsonObj->visible = $elem === "Total" || $elem === "Nail" ? true : false;
//     $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nail" ? "" : null;
//     $jsonObj->type = "spline";
//     $jsonObj->xValueFormatString = "YYYY";
//     $jsonObj->yValueFormatString = "₱#,###,###.##";
//     $arr = array();
//     $year = array(2019,2018,2017);

//     foreach($year as $key => $val){
//         $tempObj = new stdClass();
//         $tempObj->x = [intval($val),12,1];
//         $tempObj->y = mt_rand(100000,1000000);
//         array_push($arr,$tempObj);
//     }
    
//     $jsonObj->dataPoints = $arr;
//     array_push($mainArr,$jsonObj);
// }

// echo "<pre>";
// print_r($mainArr);
// echo "</pre>";

echo json_encode($mainArr);
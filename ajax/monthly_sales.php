<?php 

require_once "../support/ja_config.php";
$test = $conn->query("select Year,Month,Sum(Price) as Income,ServiceType from (
    select TransactionNumber,Month([date/time]) as [Month],YEAR([date/time]) as [Year],ServiceType, SUM(ServicePrice) as Price  from dashboard_View
    group by TransactionNumber,Month([date/time]),YEAR([date/time]),ServiceType) b
    group by ServiceType,Month,Year
    order by Year , Month")->fetchAll(PDO::FETCH_ASSOC);

    $initData = array();


foreach($test as $key => $val){
    $initData[getStringMonth($val["Month"])][$val["ServiceType"]] = $val["Income"];
}
foreach($initData as $mon => $inc){
    $total = 0;
    foreach($inc as $type => $act){
        $total += floatval($act);
        if($act === end($inc)){
            $initData[$mon]["Total"] = $total;
        }
    }
}

// print_pre($initData);
// die;

$mainArr = array();
$names = array("Hair","Face","Body","Nails","Total");
foreach($names as $index => $elem){
    $jsonObj = new stdClass();
    $jsonObj->name = $elem;
    $jsonObj->showInLegend = true;
    $jsonObj->visible = $elem === "Total" || $elem === "Nails" ? true : false;
    $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nails" ? "" : null;;
    $jsonObj->type = "spline";
    $jsonObj->xValueFormatString = "MMMM";
    $jsonObj->yValueFormatString = "₱#,###,###.##";
    $arr = array();
    foreach(range(1,12) as $key => $val){
        $tempObj = new stdClass();
        $tempObj->x = [intval(date("Y")),$val-1,1];
        $tempObj->y = array_key_exists(getStringMonth($val), $initData) ? array_key_exists($elem,$initData[getStringMonth($val)]) ? floatval($initData[getStringMonth($val)][$elem]) : 0 : 0 ;
        array_push($arr,$tempObj);
    }
    $jsonObj->dataPoints = $arr;
    array_push($mainArr,$jsonObj);
}

// print_pre($mainArr);
// die;

// $mainArr = array();
// $names = array("Hair","Face","Body","Nail","Total");
// foreach($names as $index => $elem){
//     $jsonObj = new stdClass();
//     $jsonObj->name = $elem;
//     $jsonObj->showInLegend = true;
//     $jsonObj->visible = $elem === "Total" || $elem === "Nail" ? true : false;
//     $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nail" ? "" : null;;
//     // $jsonObj->visible = true;
//     $jsonObj->type = "spline";
//     $jsonObj->xValueFormatString = "MMMM";
//     $jsonObj->yValueFormatString = "₱#,###,###.##";
//     $arr = array();
//     foreach(range(1,12) as $key => $val){
//         $tempObj = new stdClass();
//         $tempObj->x = [intval(date("Y")),$val-1,1];
//         $tempObj->y = mt_rand(10000,100000);
//         array_push($arr,$tempObj);
//     }
//     $jsonObj->dataPoints = $arr;
//     array_push($mainArr,$jsonObj);
// }


echo json_encode($mainArr);


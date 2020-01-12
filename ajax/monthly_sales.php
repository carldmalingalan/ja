<?php 

require_once "../support/ja_config.php";
$test = $conn->query("select cast([Date/Time] as Date) as Date,Sum(Price) as Income,ServiceType from (
    select TransactionNumber,[Date/Time],Month([date/time]) as [Month],YEAR([date/time]) as [Year]
	,ServiceType, SUM(ServicePrice) as Price  from dashboard_View
    group by TransactionNumber,Month([date/time]),YEAR([date/time]),ServiceType,[Date/Time]) b
   	where year	= year(getdate()) and month = Month(getdate())
	group by cast([Date/Time] as Date),ServiceType
	order by cast([Date/Time] as Date)")->fetchAll(PDO::FETCH_ASSOC);

    $initData = array();


foreach($test as $key => $val){
    $initData[$val["Date"]][$val["ServiceType"]] = $val["Income"];
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

$lastDate = date("t");

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
    $jsonObj->xValueFormatString = "MMMM DD";
    $jsonObj->yValueFormatString = "₱#,###,###.##";
    $arr = array();
    foreach(range(1,(int)$lastDate) as $key => $val){
        $val = $val < 10 ? "0".$val : $val;
        $tempObj = new stdClass();
        $tempObj->x = [intval(date("Y")),(int)date("m") - 1,$val];
        $tempObj->y = array_key_exists(date("Y-m-").$val, $initData) ? array_key_exists($elem,$initData[date("Y-m-").$val]) ? floatval($initData[date("Y-m-").$val][$elem]) : 0 : 0 ;
        array_push($arr,$tempObj);
    }
    $jsonObj->dataPoints = $arr;
    array_push($mainArr,$jsonObj);
}




echo json_encode($mainArr);


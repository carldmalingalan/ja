<?php 

require_once "../support/ja_config.php";
$test = $conn->query("select Year,Month,CONCAT('Week ',Week) as [Week Number],Sum(Price) as Income,ServiceType from (
    select Month([date/time]) as [Month],
    datediff(week, dateadd(week, datediff(week, 0, dateadd(month, datediff(month, 0, [date/time]), 0)), 0), [date/time] - 1) + 1
     as Week,YEAR([date/time]) as [Year]
    ,ServiceType, SUM(ServicePrice) as Price  from dashboard_View
    where Year([date/time]) = DATEPART(yyyy,GETDATE()) and Month([date/time]) = DATEPART(MM,GETDATE())
    group by Month([date/time]),YEAR([date/time])
    ,ServiceType,datediff(week, dateadd(week, datediff(week, 0, dateadd(month, datediff(month, 0, [date/time]), 0)), 0), [date/time] - 1) + 1
    ) b
    group by ServiceType,Month,Year,Week
    order by Year , Month,Week")->fetchAll(PDO::FETCH_ASSOC);
    
    $initData = array();
    foreach($test as $index => $val){
        $initData[$val["Week Number"]][$val["ServiceType"]] = $val["Income"];
    }

    foreach($initData as $week => $types){
        $total = 0;
        foreach($types as $type => $income){
            $total += floatval($income);
            if($income === end($types)){
                $initData[$week]["Total"] = $total;
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
        $jsonObj->visible = $elem === "Total" ? true : false;
        $jsonObj->toolTipContent = $elem === "Total" ? "" : null;
        $jsonObj->type = "spline";
        $jsonObj->xValueFormatString = "Week D";
        $jsonObj->yValueFormatString = "₱#,###,###.##";
        $arr = array();
        foreach(range(1,4) as $key => $val){
            $week = "Week {$val}";
            $tempObj = new stdClass();
            $tempObj->x = [intval(date("Y")),intval(date("m"))-1,$val];
            $tempObj->y = array_key_exists($week, $initData) ? array_key_exists($elem,$initData[$week]) ? $initData[$week][$elem] : 0.00 : 0.00;
            array_push($arr,$tempObj);
        }
        $jsonObj->dataPoints = $arr;
        array_push($mainArr,$jsonObj);
    }

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
//     $jsonObj->xValueFormatString = "Week D";
//     $jsonObj->yValueFormatString = "₱#,###,###.##";
//     $arr = array();
//     foreach(range(1,4) as $key => $val){
//         $tempObj = new stdClass();
//         $tempObj->x = [intval(date("Y")),intval(date("m"))-1,$val];
//         $tempObj->y = mt_rand(10000,100000);
//         array_push($arr,$tempObj);
//     }
//     $jsonObj->dataPoints = $arr;
//     array_push($mainArr,$jsonObj);
// }


echo json_encode($mainArr);
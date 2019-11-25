<?php 
require_once "../support/ja_config.php";

$test = $conn->query("select count(a.ServiceID) as Count,b.Emp_Fullname,ServiceType,b.EmployeeID  from tblServicesAvailed a inner join tblEmployee b
on a.EmployeeAssigned = b.EmployeeID
inner join tblServices c on a.ServiceID = c.ServiceID
where a.DataStatus = 'ACTIVE'
group by b.Emp_Fullname,ServiceType,b.EmployeeID 
order by count(a.ServiceID) DESC
")->fetchAll(PDO::FETCH_ASSOC);

$initData = array();
$employees = array();

foreach($test as $key => $val){
    $initData[$val["EmployeeID"]][$val["ServiceType"]] = $val["Count"];
    $employees[$val["EmployeeID"]] = $val["Emp_Fullname"];
}


foreach($initData as $key => $val){
    $total = 0;
    foreach($val as $type => $income){
        $total += floatval($income);
        if($income === end($val)){
            $initData[$key]["Total"] = $total;
        }
    }
}


$mainArr = array();
$names = array("Hair","Face","Body","Nails","Total");

foreach($names as $index => $elem){
    $jsonObj = new stdClass();
    $jsonObj->name = $elem;
    $jsonObj->showInLegend = true;
    $jsonObj->visible = $elem === "Total" || $elem === "Nails"? true : false;
    $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nails"? "" : null;;
    $jsonObj->type = "bar";
    $jsonObj->xValueFormatString = "";
    $jsonObj->yValueFormatString = "";
    $arr = array();
    foreach($employees as $key => $val){
        $tempObj = new stdClass();
        $tempObj->label = $val;
        $tempObj->y = array_key_exists($elem,$initData[$key]) ? intval($initData[$key][$elem]) : 0;;
        array_push($arr,$tempObj);
    }
    $jsonObj->dataPoints = $arr;
    array_push($mainArr,$jsonObj);
}

// $mainArr = array();
// $names = array("Hair","Face","Body","Nail","Total");
// $employees = array("Carl Dennis Alingalan", "Marco De Guzman", "Aila Mae Espinas", "Joel Jude Castillo", "Queenie Roes Sebucao", "Piolo Pascual", "Liza Soberano", "Kuya Jobert", "Jose Manalo");
// foreach($names as $index => $elem){
//     $jsonObj = new stdClass();
//     $jsonObj->name = $elem;
//     $jsonObj->showInLegend = true;
//     $jsonObj->visible = $elem === "Total" || $elem === "Nail" ? true : false;
//     $jsonObj->toolTipContent = $elem === "Total" || $elem === "Nail" ? "" : null;;
//     // $jsonObj->visible = true;
//     $jsonObj->type = "bar";
//     $jsonObj->xValueFormatString = "";
//     $jsonObj->yValueFormatString = "";
//     $arr = array();
//     foreach($employees as $key => $val){
//         $tempObj = new stdClass();
//         $tempObj->label = $val;
//         $tempObj->y = mt_rand(50,500);
//         array_push($arr,$tempObj);
//     }
//     $jsonObj->dataPoints = $arr;
//     array_push($mainArr,$jsonObj);
// }


echo json_encode($mainArr);


<?php 

require_once "../support/ja_config.php";

$test = $conn->query(" select a.[JA-Transaction], CustomerName, cast([Date/Time] as Datetime) as Start, 
DATEADD(mi,DATEPART(MINUTE,MAX(Duration)),DATEADD(hh,DATEPART(HOUR,MAX(Duration)), [Date/Time])) as [End] 
from tblTransactions a
inner join tblServicesAvailed b on a.[JA-Transaction] =b.TransactionID
inner join tblServices c on b.ServiceID = c.ServiceID
where TransactionStatus = 'For Appointment'
group by [JA-Transaction],CustomerName,[Date/Time]")->fetchAll(PDO::FETCH_ASSOC);


$mainArr = [];


foreach($test as $key => $val){
    $newObj = new stdClass();
    $newObj->id = ''.$val["JA-Transaction"];
    $newObj->title = $val["CustomerName"];
    $newObj->start = $val["Start"];
    $newObj->end = $val["End"];
    array_push($mainArr, $newObj);
}


// print_r($mainArr);


echo json_encode($mainArr);
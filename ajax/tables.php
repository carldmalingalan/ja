<?php 
require_once "../support/ja_config.php";

$service = $conn->query("SELECT TOP 10
CONCAT('JAServ',RIGHT('000000', 6 - LEN(CAST(ServiceID As varchar))),ServiceID) As [Service ID],
ServiceName As Name,
ServicePrice As Price,
ServiceType As Type,
(CASE ServiceStatus when 1 THEN 'Available' ELSE 'Not Available' END) As Status
from tblServices;")->fetchAll(PDO::FETCH_ASSOC);

$employee = $conn->query("SELECT TOP 10
EmployeeNo as [Employee ID],
Emp_Fullname as [Fullname],
Hire_Date as [Date Created],
Emp_Status as Status
FROM tblEmployee")->fetchAll(PDO::FETCH_ASSOC);

$instock = $conn->query("SELECT TOP 10
CONCAT('JAItem',RIGHT('000000', 6 - LEN(CAST(ItemID As varchar))),ItemID) As [Item ID],
CONCAT(ItemBrand, ' - ', ItemDescription) As [Description],
CONCAT(PhysicalStock,' ',ContainerType) As [In-Stock],
(CASE ContainerType WHEN 'Bottle' THEN CONCAT(VolumePerStock,' ML') ELSE 'N/A' END) As [In-Stock Volume],
(CASE ContainerType WHEN 'Bottle' THEN CONCAT(TotalVolume,' ML') ELSE 'N/A' END) As [Current In-Stock Volume],
CONCAT(CriticalPoint,' ',ContainerType) as [Critical Scale],
Price,
ItemClass As [Item Category]
FROM tblInventory
WHERE CriticalPoint < PhysicalStock;")->fetchAll(PDO::FETCH_ASSOC);

$outstock = $conn->query("SELECT TOP 10
CONCAT('JAItem',RIGHT('000000', 6 - LEN(CAST(ItemID As varchar))),ItemID) As [Item ID],
CONCAT(ItemBrand, ' - ', ItemDescription) As [Description],
CONCAT(PhysicalStock,' ',ContainerType) As [In-Stock],
(CASE ContainerType WHEN 'Bottle' THEN CONCAT(VolumePerStock,' ML') ELSE 'N/A' END) As [In-Stock Volume],
(CASE ContainerType WHEN 'Bottle' THEN CONCAT(TotalVolume,' ML') ELSE 'N/A' END) As [Current In-Stock Volume],
CONCAT(CriticalPoint,' ',ContainerType) as [Critical Scale],
Price,
ItemClass As [Item Category]
FROM tblInventory
WHERE CriticalPoint > PhysicalStock;")->fetchAll(PDO::FETCH_ASSOC);

$serviceTbl = "";
$employeeTbl = "";
$instockTbl = "";
$outstockTbl = "";

foreach($service as $key => $val){
    $price = "₱ ".number_format($val['Price'],2,".",",");
    $temp = "<tr>
    <td>{$val['Service ID']}</td>
    <td>{$val['Name']}</td>
    <td>{$price}</td>
    <td>{$val['Type']}</td>
    <td>{$val['Status']}</td>
    </tr>";
    $serviceTbl .= $temp;
}

foreach($employee as $key => $val){
    $temp = "<tr>
    <td>{$val['Employee ID']}</td>
    <td>{$val['Fullname']}</td>
    <td>{$val['Date Created']}</td>
    <td>{$val['Status']}</td>
    </tr>";
    $employeeTbl .= $temp;
}
foreach($instock as $key => $val){
    $price = "₱ ".number_format($val['Price'],2,".",",");
    $temp = "<tr>
    <td>{$val['Item ID']}</td>
    <td>{$val['Description']}</td>
    <td>{$val['In-Stock']}</td>
    <td>{$val['In-Stock Volume']}</td>
    <td>{$val['Current In-Stock Volume']}</td>
    <td>{$val['Critical Scale']}</td>
    <td>{$price}</td>
    <td>{$val['Item Category']}</td>
    </tr>";
    $instockTbl .= $temp;
}

foreach($outstock as $key => $val){
    $price = "₱ ".number_format($val['Price'],2,".",",");
    $temp = "<tr>
    <td>{$val['Item ID']}</td>
    <td>{$val['Description']}</td>
    <td>{$val['In-Stock']}</td>
    <td>{$val['In-Stock Volume']}</td>
    <td>{$val['Current In-Stock Volume']}</td>
    <td>{$val['Critical Scale']}</td>
    <td>{$price}</td>
    <td>{$val['Item Category']}</td>
    </tr>";
    $outstockTbl .= $temp;
}




// echo $serviceTbl;
// die;

$retObj = new stdClass();
$retObj->serviceTable = $serviceTbl;
$retObj->employeeTable = $employeeTbl;
$retObj->instockTable = $instockTbl;
$retObj->outstockTable = $outstockTbl;

echo json_encode($retObj);
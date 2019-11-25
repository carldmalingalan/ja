<?php 
require_once "../support/ja_config.php";

$test = $conn->query("SELECT 
(SELECT COUNT(*) FROM tblEmployee WHERE Emp_Status = 'Active') AS EmployeeNo, 
(SELECT COUNT(*) FROM tblServices WHERE ServiceStatus = 1) AS ServiceNo,
(SELECT COUNT(*) FROM tblInventory WHERE CriticalPoint < PhysicalStock) As ProductNo,
(SELECT COUNT(*) FROM tblInventory WHERE CriticalPoint > PhysicalStock) AS OutOfStockNo")->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($test);

<?php 
require_once "../support/fpdf.php";
require_once "../support/ja_config.php";
$service = $conn->query("SELECT
CONCAT('JAServ',RIGHT('000000', 6 - LEN(CAST(ServiceID As varchar))),ServiceID) As [Service ID],
ServiceName As Name,
ServicePrice As Price,
ServiceType As Type,
(CASE ServiceStatus when 1 THEN 'Available' ELSE 'Not Available' END) As Status
from tblServices;")->fetchAll(PDO::FETCH_ASSOC);

$acctId = $_GET["id"];
$userName = $conn->query("select AccountFullname As UName
 from tblAccounts where AccountID = {$acctId}")->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDF("P", "mm", "Letter");
$pdf->addPage();
$pdf->SetTitle('List of Services Report');

$pdf->Image("BG_Circle.png",-110,-20, 300, 150);
$pdf->FooterName = $userName[0]["UName"];
$pdf->SetFont('Arial','',12);
$pdf->Cell('100','5','J&A Inventory and Records Management System',0,1,'l');
$pdf->SetFont('Arial','',15);
$pdf->Cell('195','10',date('Y')." List of Services Report",0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(39,'5',"Service ID",1,0,'C');
$pdf->Cell(39,'5',"Name",1,0,'C');
$pdf->Cell(39,'5',"Price",1,0,'C');
$pdf->Cell(39,'5',"Type",1,0,'C');
$pdf->Cell(39,'5',"Status",1,1,'C');

foreach($service as $key => $val){
    $pdf->Cell(39,'5',$val["Service ID"],1,0,'C');
    $pdf->Cell(39,'5',$val["Name"],1,0,'C');
    $pdf->Cell(39,'5',"P ".sanitizeMoney($val["Price"]),1,0,'C');
    $pdf->Cell(39,'5',$val["Type"],1,0,'C');
    $pdf->Cell(39,'5',$val["Status"],1,1,'C');
}





$pdf->Output("I", "list_services_report.pdf");
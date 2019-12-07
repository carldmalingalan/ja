<?php 
require_once "../support/fpdf.php";
require_once "../support/ja_config.php";
$employee = $conn->query("SELECT
EmployeeNo as [Employee ID],
Emp_Fullname as [Fullname],
Hire_Date as [Date Created],
Emp_Status as Status
FROM tblEmployee")->fetchAll(PDO::FETCH_ASSOC);

$acctId = $_GET["id"];
$userName = $conn->query("select AccountFullname As UName
 from tblAccounts where AccountID = {$acctId}")->fetchAll(PDO::FETCH_ASSOC);


$pdf = new FPDF("P", "mm", "Letter");
$pdf->addPage();
$pdf->SetTitle('List of Employees Report');

$pdf->Image("BG_Circle.png",-110,-20, 300, 150);
$pdf->FooterName = $userName[0]["UName"];
$pdf->SetFont('Arial','',12);
$pdf->Cell('100','5','J&A Inventory and Records Management System',0,1,'l');
$pdf->SetFont('Arial','',8);
$pdf->Cell(100,'5',"711 Boni Avenue Mandaluyong City",0,1,"l");
$pdf->SetFont('Arial','',15);
$pdf->Cell('195','10',date('Y')." List of Employees Report",0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(48.75,'5',"Employee ID",1,0,'C');
$pdf->Cell(48.75,'5',"Fullname",1,0,'C');
$pdf->Cell(48.75,'5',"Date Created",1,0,'C');
$pdf->Cell(48.75,'5',"Status",1,1,'C');

foreach($employee as $key => $val){
    $pdf->Cell(48.75,'5',$val["Employee ID"],1,0,'C');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(48.75,'5',$val["Fullname"],1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(48.75,'5',$val["Date Created"],1,0,'C');
    $pdf->Cell(48.75,'5',$val["Status"],1,1,'C');
}


$pdf->Output("I", "list_employees_report.pdf");
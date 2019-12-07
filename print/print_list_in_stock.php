<?php 
require_once "../support/fpdf.php";
require_once "../support/ja_config.php";
$instock = $conn->query("SELECT
CONCAT('JAItem',RIGHT('000000', 6 - LEN(CAST(ItemID As varchar))),ItemID) As [Item ID],
ItemBrand As [Brand],
ItemDescription As [Description],
CONCAT(PhysicalStock,' ',ContainerType) As [In-Stock],
(CASE ContainerType WHEN 'Bottle' THEN CONCAT(VolumePerStock,' ML') ELSE 'N/A' END) As [In-Stock Volume],
(CASE ContainerType WHEN 'Bottle' THEN CONCAT(TotalVolume,' ML') ELSE 'N/A' END) As [Current In-Stock Volume],
CONCAT(CriticalPoint,' ',ContainerType) as [Critical Scale],
Price,
ItemClass As [Item Category]
FROM tblInventory
WHERE CriticalPoint < PhysicalStock;")->fetchAll(PDO::FETCH_ASSOC);


$acctId = $_GET["id"];
$userName = $conn->query("select AccountFullname As UName
 from tblAccounts where AccountID = {$acctId}")->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDF("P", "mm", "Letter");
$pdf->addPage();
$pdf->SetTitle('List of In-Stock Items Report');

$pdf->Image("BG_Circle.png",-110,-20, 300, 150);
$pdf->FooterName = $userName[0]["UName"];
$pdf->SetFont('Arial','',12);
$pdf->Cell('100','5','J&A Inventory and Records Management System',0,1,'l');
$pdf->SetFont('Arial','',8);
$pdf->Cell(100,'5',"711 Boni Avenue Mandaluyong City",0,1,"l");
$pdf->SetFont('Arial','',15);
$pdf->Cell('195','10',date('Y')." List of In-Stock Items Report",0,1,'C');
$pdf->SetFont('Arial','',7);
$pdf->Cell(21.6666666667,'5',"Item ID",1,0,'C');
$pdf->Cell(21.6666666667,'5',"Brand",1,0,'C');
$pdf->Cell(21.6666666667,'5',"Description",1,0,'C');
$pdf->Cell(21.6666666667,'5',"In-Stock",1,0,'C');
$pdf->Cell(21.6666666667,'5',"Volume Per Stock",1,0,'C');
$pdf->Cell(21.6666666667,'5',"Current Volume",1,0,'C');
$pdf->Cell(21.6666666667,'5',"Critical Scale",1,0,'C');
$pdf->Cell(21.6666666667,'5',"Price",1,0,'C');
$pdf->Cell(21.6666666667,'5',"Category",1,1,'C');
$pdf->SetFont('Arial','',6);
foreach($instock as $key => $val){
    $pdf->Cell(21.6666666667,'5',$val["Item ID"],1,0,'C');
    $pdf->Cell(21.6666666667,'5',$val["Brand"],1,0,'C');
    $pdf->Cell(21.6666666667,'5',$val["Description"],1,0,'C');
    $pdf->Cell(21.6666666667,'5',$val["In-Stock"],1,0,'C');
    $pdf->Cell(21.6666666667,'5',$val["In-Stock Volume"],1,0,'C');
    $pdf->Cell(21.6666666667,'5',$val["Current In-Stock Volume"],1,0,'C');
    $pdf->Cell(21.6666666667,'5',$val["Critical Scale"],1,0,'C');
    $pdf->Cell(21.6666666667,'5',"P ".sanitizeMoney($val["Price"]),1,0,'C');
    $pdf->Cell(21.6666666667,'5',$val["Item Category"],1,1,'C');
}


$pdf->Output("I", "list_in_stock_report.pdf");
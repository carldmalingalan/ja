<?php 
require_once "../support/config.php";
require_once "../support/fpdf.php";

$categ = array("Hair","Face","Nail","Body");

$pdf = new FPDF("P", "mm", "Letter");
$pdf->addPage();
$pdf->SetTitle('Monthly Report');

$pdf->Image("BG_Circle.png",-110,-20, 300, 150);
$pdf->FooterName = "Carl Dennis Alignalan";
$pdf->SetFont('Arial','',12);
$pdf->Cell('100','5','J&A Inventory and Records Management System',0,1,'l');
$pdf->SetFont('Arial','',15);
$pdf->Cell('195','10',date('Y')." Monthly Sales Report",0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(48.75,'5',"Day",1,0,'C');
$pdf->Cell(48.75,'5',"Categories",1,0,'C');
$pdf->Cell(48.75,'5',"Total Per Category",1,0,'C');
$pdf->Cell(48.75,'5',"Total",1,1,'C');


$finalTotal = 0;
foreach(range(1,12) as $key => $val){
    $total = 0;
    foreach($categ as $key1 => $val1){
        $current = mt_rand(10000,100000); ;
        $total += intval($current);
        if($key1 === 0){
            $pdf->Cell(48.75,5,date("F",strtotime(date ("Y/".$val."/d"))),1,0,"C");
            $pdf->Cell(48.75,5,$val1,1,0,"C");
            $pdf->Cell(48.75,5,"P ".number_format($current,2,".",","),1,0,"C");
            $pdf->Cell(48.75,5,"",1,1,"C");
        }else{
            $pdf->Cell(48.75,5,"",1,0,"C");
            $pdf->Cell(48.75,5,$val1,1,0,"C");
            $pdf->Cell(48.75,5,"P ".number_format($current,2,".",","),1,0,"C");
            $pdf->Cell(48.75,5,"",1,1,"C");
        }
    }
    $pdf->Cell(48.75,5,"",1,0,"C");
    $pdf->Cell(48.75,5,"",1,0,"C");
    $pdf->Cell(48.75,5,"",1,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format($total,2,".",","),1,1,"C");
    $finalTotal += $total;
}

    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format($finalTotal,2,".",","),"B",1,"C");



$pdf->Output("I", "monthly_".date("Y")."_report.pdf");
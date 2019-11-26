<?php 

require_once "../support/fpdf.php";
require_once "../support/ja_config.php";
$test = $conn->query("select Year,Month,Sum(Price) as Income,ServiceType from (
    select TransactionNumber,Month([date/time]) as [Month],YEAR([date/time]) as [Year],ServiceType, SUM(ServicePrice) as Price  from dashboard_View
    group by TransactionNumber,Month([date/time]),YEAR([date/time]),ServiceType) b
    group by ServiceType,Month,Year
    order by Year , Month")->fetchAll(PDO::FETCH_ASSOC);

    $initData = array();
    
$acctId = $_GET["id"];
$userName = $conn->query("select AccountFullname As UName
 from tblAccounts where AccountID = {$acctId}")->fetchAll(PDO::FETCH_ASSOC);


foreach($test as $key => $val){
    $initData[getStringMonth($val["Month"])][$val["ServiceType"]] = $val["Income"];
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

// print_pre($initData);
// die;

$categ = array("Hair","Face","Nails","Body");

$pdf = new FPDF("P", "mm", "Letter");
$pdf->addPage();
$pdf->SetTitle('Monthly Report');

$pdf->Image("BG_Circle.png",-110,-20, 300, 150);
$pdf->FooterName = $userName[0]["UName"];
$pdf->SetFont('Arial','',12);
$pdf->Cell('100','5','J&A Inventory and Records Management System',0,1,'l');
$pdf->SetFont('Arial','',15);
$pdf->Cell('195','10',date('Y')." Monthly Sales Report",0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(48.75,'5',"Month",1,0,'C');
$pdf->Cell(48.75,'5',"Categories",1,0,'C');
$pdf->Cell(48.75,'5',"Total Per Category",1,0,'C');
$pdf->Cell(48.75,'5',"Total",1,1,'C');


$finalTotal = 0;
foreach(range(1,12) as $key => $val){
    $final = array_key_exists(getStringMonth($val),$initData) ? floatval($initData[getStringMonth($val)]["Total"]) : 0;
    
    foreach($categ as $key1 => $val1){
        $current = array_key_exists(getStringMonth($val),$initData) ? array_key_exists($val1,$initData[getStringMonth($val)]) ? $initData[getStringMonth($val)][$val1] : 0 : 0;
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
    $pdf->Cell(48.75,5,"P ".number_format($final,2,".",","),1,1,"C");
    
    $finalTotal += $final;
}



    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format($finalTotal,2,".",","),"B",1,"C");



$pdf->Output("I", "monthly_".date("Y")."_report.pdf");
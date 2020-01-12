<?php 

require_once "../support/fpdf.php";
require_once "../support/ja_config.php";
$test = $conn->query("select cast([Date/Time] as Date) as Date,Sum(Price) as Income,ServiceType from (
    select TransactionNumber,[Date/Time],Month([date/time]) as [Month],YEAR([date/time]) as [Year]
	,ServiceType, SUM(ServicePrice) as Price  from dashboard_View
    group by TransactionNumber,Month([date/time]),YEAR([date/time]),ServiceType,[Date/Time]) b
   	where year	= year(getdate()) and month = Month(getdate())
	group by cast([Date/Time] as Date),ServiceType
	order by cast([Date/Time] as Date)")->fetchAll(PDO::FETCH_ASSOC);

    $initData = array();
    
$acctId = $_GET["id"];
$userName = $conn->query("select AccountFullname As UName
 from tblAccounts where AccountID = {$acctId}")->fetchAll(PDO::FETCH_ASSOC);


foreach($test as $key => $val){
    $initData[$val["Date"]][$val["ServiceType"]] = $val["Income"];
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



$lastDate = date("t");
// echo date("Y-m-")."1";
// print_pre($initData);
// die;

$categ = array("Hair","Face","Nails","Body");

$pdf = new FPDF("P", "mm", "Letter");
$pdf->AliasNbPages();
$pdf->HeaderTitle = "Monthly Sales Report (".date("F")."1-{$lastDate})";
$pdf->addPage();
$pdf->FooterName = $userName[0]["UName"];
$pdf->SetTitle('Monthly Report');
$pdf->SetFont('Arial','',10);
$pdf->Cell(48.75,'5',"Month",1,0,'C');
$pdf->Cell(48.75,'5',"Categories",1,0,'C');
$pdf->Cell(48.75,'5',"Total Price Per Category",1,0,'C');
$pdf->Cell(48.75,'5',"Total",1,1,'C');




$finalTotal = 0;
foreach(range(1,(int)$lastDate) as $key => $val){
    $val = $val < 10 ? "0".$val : $val;
    $final = array_key_exists(date("Y-m-")."{$val}",$initData) ? floatval($initData[date("Y-m-")."{$val}"]["Total"]) : 0;

    foreach($categ as $key1 => $val1){
        $current = array_key_exists(date("Y-m-").$val,$initData) ? array_key_exists($val1,$initData[date("Y-m-").$val]) ? $initData[date("Y-m-").$val][$val1] : 0 : 0;

        if($key1 === 0){
            $pdf->Cell(48.75,5,"".date("Y-m-")."{$val}",1,0,"L");
            $pdf->Cell(48.75,5,$val1,1,0,"L");
            $pdf->Cell(48.75,5,"P ".number_format($current,2,".",","),1,0,"R");
            $pdf->Cell(48.75,5,"",1,1,"R");
        }else{
            $pdf->Cell(48.75,5,"",1,0,"L");
            $pdf->Cell(48.75,5,$val1,1,0,"L");
            $pdf->Cell(48.75,5,"P ".number_format($current,2,".",","),1,0,"R");
            $pdf->Cell(48.75,5,"",1,1,"R");
        }
    }
    $pdf->Cell(48.75,5,"",1,0,"L");
    $pdf->Cell(48.75,5,"",1,0,"L");
    $pdf->Cell(48.75,5,"",1,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format($final,2,".",","),1,1,"R");
    
    $finalTotal += $final;
}



    $pdf->Cell(48.75,5,"",0,0,"L");
    $pdf->Cell(48.75,5,"",0,0,"L");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format($finalTotal,2,".",","),"B",1,"R");



$pdf->Output("I", "monthly_".date("Y")."_report.pdf");
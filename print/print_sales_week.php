<?php 

require_once "../support/fpdf.php";
require_once "../support/ja_config.php";
$test = $conn->query("select Year,Month,CONCAT('Week ',Week) as [Week Number],Sum(Price) as Income,ServiceType from (
    select Month([date/time]) as [Month],
    datediff(week, dateadd(week, datediff(week, 0, dateadd(month, datediff(month, 0, [date/time]), 0)), 0), [date/time] - 1) + 1
     as Week,YEAR([date/time]) as [Year]
    ,ServiceType, SUM(ServicePrice) as Price  from dashboard_View
    where Year([date/time]) = DATEPART(yyyy,GETDATE()) and Month([date/time]) = DATEPART(MM,GETDATE())
    group by Month([date/time]),YEAR([date/time])
    ,ServiceType,datediff(week, dateadd(week, datediff(week, 0, dateadd(month, datediff(month, 0, [date/time]), 0)), 0), [date/time] - 1) + 1
    ) b
    group by ServiceType,Month,Year,Week
    order by Year , Month,Week")->fetchAll(PDO::FETCH_ASSOC);
    
    
$acctId = $_GET["id"];
$userName = $conn->query("select AccountFullname As UName
 from tblAccounts where AccountID = {$acctId}")->fetchAll(PDO::FETCH_ASSOC);
    $initData = array();
    foreach($test as $index => $val){
        $initData[$val["Week Number"]][$val["ServiceType"]] = $val["Income"];
    }

    foreach($initData as $week => $types){
        $total = 0;
        foreach($types as $type => $income){
            $total += floatval($income);
            if($income === end($types)){
                $initData[$week]["Total"] = $total;
            }
        }
    }

$categ = array("Hair","Face","Nails","Body");

$pdf = new FPDF("P", "mm", "Letter");
$pdf->addPage();
$pdf->SetTitle('Weekly ('.date("F").') Report');

$pdf->Image("BG_Circle.png",-110,-20, 300, 150);
$pdf->FooterName = $userName[0]["UName"];
$pdf->SetFont('Arial','',12);
$pdf->Cell('100','5','J&A Inventory and Records Management System',0,1,'l');
$pdf->SetFont('Arial','',8);
$pdf->Cell(100,'5',"711 Boni Avenue Mandaluyong City",0,1,"l");
$pdf->SetFont('Arial','',15);
$pdf->Cell('195','10',date('Y')." Weekly Sales Report",0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(48.75,'5',"Week",1,0,'C');
$pdf->Cell(48.75,'5',"Categories",1,0,'C');
$pdf->Cell(48.75,'5',"Total Per Category",1,0,'C');
$pdf->Cell(48.75,'5',"Total",1,1,'C');


$finalTotal = 0;
foreach(range(1,4) as $key => $val){
    $total = array_key_exists("Week {$val}",$initData) ? floatval($initData["Week {$val}"]["Total"]) : 0;
    foreach($categ as $key1 => $val1){
        $current = array_key_exists("Week {$val}",$initData) ? array_key_exists($val1,$initData["Week {$val}"]) ? $initData["Week {$val}"][$val1] : 0 : 0;
        if($key1 === 0){
            $pdf->Cell(48.75,5,"Week ".$val,1,0,"L");
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
    $pdf->Cell(48.75,5,"P ".number_format($total,2,".",","),1,1,"R");
    $finalTotal += $total;
}

    $pdf->Cell(48.75,5,"",0,0,"L");
    $pdf->Cell(48.75,5,"",0,0,"L");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format($finalTotal,2,".",","),"B",1,"R");



$pdf->Output("I", "weekly_".date("F")."_report.pdf");
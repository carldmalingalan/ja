<?php 
require_once "../support/fpdf.php";
require_once "../support/ja_config.php";

$test = $conn->query("select SUM(ServicePrice) as Total,b.Emp_Fullname,ServiceType,b.EmployeeID 
from tblServicesAvailed a 
inner join tblEmployee b on a.EmployeeAssigned = b.EmployeeID
inner join tblServices c on a.ServiceID = c.ServiceID
where a.DataStatus = 'ACTIVE'
group by b.Emp_Fullname,ServiceType,b.EmployeeID
order by SUM(ServicePrice) DESC
")->fetchAll(PDO::FETCH_ASSOC);
$initData = array();
$employees = array();

foreach($test as $key => $val){
    $initData[$val["EmployeeID"]][$val["ServiceType"]] = $val["Total"];
    $employees[$val["EmployeeID"]] = $val["Emp_Fullname"];
}


foreach($initData as $key => $val){
    $total = 0;
    foreach($val as $type => $income){
        $total += floatval($income);
        if($income === end($val)){
            $initData[$key]["Total"] = $total;
        }
    }
}


$categ = array("Hair","Face","Nails","Body");

$pdf = new FPDF("P", "mm", "Letter");
$pdf->addPage();
$pdf->SetTitle('Employee Ranking (Per Income)');

$pdf->Image("BG_Circle.png",-110,-20, 300, 150);
$pdf->FooterName = "Carl Dennis Alignalan";
$pdf->SetFont('Arial','',12);
$pdf->Cell('100','5','J&A Inventory and Records Management System',0,1,'l');
$pdf->SetFont('Arial','',15);
$pdf->Cell('195','10',"Employee Ranking (Per Income)",0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(48.75,'5',"Name",1,0,'C');
$pdf->Cell(48.75,'5',"Categories",1,0,'C');
$pdf->Cell(48.75,'5',"Total Per Category",1,0,'C');
$pdf->Cell(48.75,'5',"Total",1,1,'C');




$finalTotal = 0;
foreach($initData as $key => $val){
    
    foreach($categ as $key1 => $val1){
        
        $income =  array_key_exists($val1,$val) ? "P ".number_format(floatval($val[$val1]),2,".",",") : "0.00";

        if($key1 === 0){
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(48.75,5,$employees[$key],1,0,"C");
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(48.75,5,$val1,1,0,"C");
            $pdf->Cell(48.75,5,$income,1,0,"C");
            $pdf->Cell(48.75,5,"",1,1,"C");
        }else{
            $pdf->Cell(48.75,5,"",1,0,"C");
            $pdf->Cell(48.75,5,$val1,1,0,"C");
            $pdf->Cell(48.75,5,$income,1,0,"C");
            $pdf->Cell(48.75,5,"",1,1,"C");
        }
    }
    $pdf->Cell(48.75,5,"",1,0,"C");
    $pdf->Cell(48.75,5,"",1,0,"C");
    $pdf->Cell(48.75,5,"",1,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format(floatval($val["Total"]),2,".",","),1,1,"C");
    $finalTotal += floatval($val["Total"]);
    
}
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"",0,0,"C");
    $pdf->Cell(48.75,5,"P ".number_format($finalTotal,2,".",","),"B",1,"C");



$pdf->Output("I", "employee_rank_income_report.pdf");
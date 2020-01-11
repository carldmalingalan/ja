<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>J&A Charts and Reporting</title>

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" >
    <link href='datepicker/datepicker3.css' rel='stylesheet'/>
    <link href='packages/core/main.css' rel='stylesheet' />
<link href='packages/daygrid/main.css' rel='stylesheet' />
<link href='packages/timegrid/main.css' rel='stylesheet' />
<link href='packages-premium/timeline/main.css' rel='stylesheet' />
<link href='packages-premium/resource-timeline/main.css' rel='stylesheet' />

    
    <style>
        section {
            width: 100vw;
            height: 100vh;
            /* background-color: #EEE;
            border: 1px solid black;
            margin-bottom:50px; */
        }
        .custom-container {
            padding-top: 10px;            
        }

        .custom-card {
            background-color: #efffc7;
            border: 1px solid #c6ff4a;
            transition: .3s;
        }

        .card {
            box-shadow: 1px 2px 2px 1px #999999 !important;
            border-radius: 1.5px !important;
        }

        .custom-col {
            margin-bottom: 10px;
        }

        .anchor_link {
            text-decoration: none !important;
            cursor: pointer !important;
            color: black !important;
        }
        .anchor_link:hover {
            color: black !important;
        }
        a {
            text-decoration: none;
            cursor: pointer;
            color: #00A  !important;
        }
        a:hover {
            color: white !important;
        }
        .disabled:hover {
        cursor: not-allowed !important;
        }


    </style>
</head>
<body>

<section>
<div class="container">
    <div class="custom-container">
        <div class="text-center">
            <h1>J&A Charts and Reporting </h1>
        </div>
        <div class="row">
        
        <div class="custom-col col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <a href="#serviceAnchor" class="anchor_link">
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5>Service</h5>
                    
                    <h3 id="ServiceNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                    
                </div>
            </div>
            </a>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <a href="#employeeAnchor" class="anchor_link">
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5>Employee</h5>
                    <h3 id="EmployeeNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                </div>
            </div>
            </a>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
        <a href="#instockAnchor" class="anchor_link">
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5 >Product</h5>
                    <h3 id="ProductNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                </div>
            </div>
            </a>
        </div>
            <div class="custom-col col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <a href="#outstockAnchor" class="anchor_link">
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5>Restock</h5>
                    <h3 id="OutOfStockNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                </div>
            </div>
            </a>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                <div class="card">
                    <div class="card-body"><div id="appointment-calendar"></div></div>
                </div>
                
            </div>
            <div class="custom-col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
            <div class="card-body text-center">
            
            <div class="btn-group btn-group-toggle" id="reportOptions" data-toggle="buttons">
                <label class="btn btn-outline-primary active">
                    <input type="radio" name="options" id="annual" checked> Annual
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio" name="options" id="monthly"> Monthly
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio" name="options" id="weekly"> Weekly
                </label>
                </div>
                <div id="sales-annual" style="height: 300px; width: 100%;"></div>
                <a target="_blank" id="salesPrintButton" href="print/print_sales_annual.php/?id=<?php echo $_GET["id"];?>" data-user="<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
            
        </div>
            </div>
           
            
            <div class="custom-col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
            <div class="card-body text-center">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">From</span>
                        </div>
                        <input type="text" class="form-control datepickerFrom">
                    </div>
                    </div>
                </div>
                <div class="col-6"><div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">To</span>
                        </div>
                        <input type="text" disabled class="form-control datepickerTo disabled">
                    </div>
                    </div>
                </div></div>
            </div>
                <div id="employee-profit-ranking" style="height: 300px; width: 100%;"></div>
                <a target="_blank" href="print/print_employee_income.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
        </div>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
            <div class="card-body text-center" id="serviceAnchor">
            <h3>List of Services</h3>
            <div class="table-responsive-sm">
                <table class="table table-sm table-bordered" id="serviceTable">
                <thead>
                    <tr>
                    <th>Service ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Status</th>
                    </tr>
                </thead>
                </table>
            </div>
            <a target="_blank" href="print/print_list_services.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
            </div>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
            <div class="card-body text-center" id="employeeAnchor">
            <h3>List of Employees</h3>
            <div class="table-responsive-sm">
                <table class="table table-sm table-bordered" id="employeeTable">
                <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Fullname</th>
                    <th>Date Created</th>
                    <th>Status</th>
                </tr>
                </thead>
                </table>
            </div>
            <a target="_blank" href="print/print_list_employees.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>

            </div>
            </div>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
            <div class="card-body text-center" id="instockAnchor">
            <h3>List of In-Stock Items</h3>
            <div class="table-responsive-sm" style="width: 100%;">
            <table class="table table-sm table-bordered" id="instockTable">
                <thead>
                <tr>
                <th>Item ID</th>
                    <th>Description</th>
                    <th>In-Stock</th>
                    <th>Per Volume</th>
                    <th>Current Volume</th>
                    <th>Critical Scale</th>
                    <th>Price</th>
                    <th>Category</th>
                </tr>
                </thead>
                </table>
            </div>
            <a target="_blank" href="print/print_list_in_stock.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
            </div>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
            <div class="card-body text-center" id="outstockAnchor">
            <h3>List of Out of Stock Items</h3>
            <div class="table-responsive-sm">
                <table class="table table-sm table-bordered" id="outstockTable">
                <thead>
                <tr>
                <th>Item ID</th>
                    <th>Description</th>
                    <th>In-Stock</th>
                    <th>Per Volume</th>
                    <th>Current Volume</th>
                    <th>Critical Scale</th>
                    <th>Price</th>
                    <th>Category</th>
                </tr>
                </thead>
                </table>
            </div>
            <a target="_blank" href="print/print_list_out_stock.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
            </div>
        </div>

    </div>
</div>
</section>

<script src="jquery/jquery.3.4.1.min.js" ></script>
<script src="bootstrap/popper.min.js" ></script>

<script src="canvasjs-2.3.2/canvasjs.min.js"></script>
<script src="momentjs/moment.js"></script>
<script src="bootstrap/bootstrap.min.js" ></script>
<script src="datepicker/bootstrap-datepicker.js"></script>

<script src='packages/core/main.js'></script>
<script src='packages/interaction/main.js'></script>
<script src='packages/daygrid/main.js'></script>
<script src='packages/timegrid/main.js'></script>
<script src='packages-premium/timeline/main.js'></script>
<script src='packages-premium/resource-common/main.js'></script>
<script src='packages-premium/resource-timeline/main.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $.ajax({
        url: "ajax/appointments.php",
        dataType: "JSON",
        global: true,
        success: data => {
            let clel = document.getElementById("appointment-calendar");
            
            let calendar = new FullCalendar.Calendar(clel,{
                plugins:['dayGrid', 'timeGrid'],
                height: 500,
                header: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay'
  },
                events: [...data]
            });

            calendar.render();

        },
        error: err => console.error(err)
    })
    });
$(document).ready(function(){ 

    $('[data-toggle="tooltip"]').tooltip();
    $(".datepickerFrom").datepicker({ clearBtn: true }).on("changeDate", function(e){ 
        let dateSelected = e.dates[0];
        $(".datepickerTo").attr({disabled: false});        
            $(".datepickerTo").removeClass("disabled");
            $(".datepickerTo").datepicker("remove");
            $(".datepickerTo").datepicker({ clearBtn: true, startDate: new Date(dateSelected), todayHighlight: true });
     }).on("clearDate",function(e){
        $(".datepickerTo").attr({disabled: true}).val("");     
            $(".datepickerTo").datepicker("clearDates");   
            $(".datepickerTo").addClass("disabled");
     });

    

    function salesReport(id){
        
        let title = "";
        let chartSales;
        let btnHref = "print/"
        let config = {
	animationEnabled: true,
	axisX:{
		valueFormatString: id === 'annual' ? "YYYY" : id === 'monthly' ? "MMM" : "Week D"
	},
	axisY: {
		title: "Closing Price",
		includeZero: false,
		valueFormatString: "₱#,###,###.##"
	},
    toolTip: {
        shared: true
    },
    legend: {
        cursor: "pointer",
        itemclick: isClickLegend
    }
}


        switch(id){
            case "annual":
                title = "Sales Report - Annual";
                btnHref += "print_sales_annual.php/?id=";
                break;
            case "monthly":
                 title = `Sales Report - Monthly (${moment().format("YYYY")})`
                 btnHref += "print_sales_month.php/?id=";
                 break;
            case "weekly":
                 title = `Sales Report - Weekly (${moment().format("MMMM")})`
                 btnHref += "print_sales_week.php/?id=";
                 break;
            default:
             title;
        }
        config['title'] = {text: title};
        $.ajax({
        url: `ajax/${id}_sales.php`,
        dataType: "JSON",
        global: true,
        success:function(data) {
            let userId = $("#salesPrintButton").data("user");
            console.log(userId);
            $("#salesPrintButton").attr("href", btnHref += userId)
            let finalData = data.map(m2Val => ({ ...m2Val, dataPoints: m2Val.dataPoints.map(mVal => ({...mVal, x: new Date(mVal.x[0], mVal.x[1], mVal.x[2])})) }))
            config["data"] = [...finalData]
            chartSales = new CanvasJS.Chart(`sales-annual`,config);
            chartSales.render();
            
        },
        error: function(data){
            console.log(data)
        }
    })
    function isClickLegend(e){
    if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
        e.dataSeries["toolTipContent"] = null;
	}
	else {
		e.dataSeries.visible = true;            
        delete e.dataSeries["toolTipContent"] || "";
	}
    chartSales.render();
}
    }
    $("#reportOptions").on("change", function(e){
        const id = e.target.id;
        salesReport(id);
    })

    
       
 


    let annualData = [], monthlyData = [], weeklyData = [], service = [], profit = [];



let annually =  new CanvasJS.Chart("sales-annual", {
	animationEnabled: true,
	title:{
		text: `Sales Report - Annual `
	},
	axisX:{
		valueFormatString: "YYYY"
	},
	axisY: {
		title: "Closing Price",
		includeZero: false,
		valueFormatString: "₱#,###,###.##"
	},
    toolTip: {
        shared: true
    },
    legend: {
        cursor: "pointer",
        itemclick: annuallyLegendChange
    },
    data: annualData
	
});


let profitRank = new CanvasJS.Chart("employee-profit-ranking",{animationEnabled: true,
	title:{
		text: `Employee Ranking (Cost Performance)`
	},
	
	axisY: {
		title: "Closing Profit",
		includeZero: false,
        valueFormatString: "₱#,###,###.##"
	},
    toolTip: {
        shared: true
    },
    legend: {
        cursor: "pointer",
        itemclick: EmpProfitLegendChange
    },
    data: profit});
// Wierd 



function annuallyLegendChange(e){
    if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
        e.dataSeries["toolTipContent"] = null;
	}
	else {
		e.dataSeries.visible = true;            
        delete e.dataSeries["toolTipContent"] || "";
	}
    annually.render();
}






function EmpProfitLegendChange(e){
    if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
        e.dataSeries["toolTipContent"] = null;
	}
	else {
		e.dataSeries.visible = true;            
        delete e.dataSeries["toolTipContent"] || "";
	}
    profitRank.render();
}
    $.ajax({
        url: "ajax/annual_sales.php",
        dataType: "JSON",
        globa: true,
        success:function(data) {
            let finalData = data.map(m2Val => ({ ...m2Val, dataPoints: m2Val.dataPoints.map(mVal => ({...mVal, x: new Date(mVal.x[0], mVal.x[1]-1, mVal.x[2])})) }))
            annualData.push(...finalData);
            annually.render();
            
        },
        error: function(data){
            console.log(data)
        }
    })
   
    
  
    $.ajax({
        url: "ajax/employee_ranking_profit.php",
        dataType: "JSON",
        success:function(data) {
            profit.push(...data);
           profitRank.render();
        },
        error: function(data){
            console.log(data)
        }
    })

    $.ajax({
        url: "ajax/badges.php",
        dataType: "JSON",
        success: function(data){
            let keys = Object.keys(data[0]);
            keys.forEach(val => {
                $(`#${val}`).append(data[0][val]);
            })
        },
        error: function(data){
            console.log(data);
        }
    })

    $.ajax({
        url: "ajax/tables.php",
        dataType: "JSON",
        success: function(data){
            
            let keys = Object.keys(data);
            keys.forEach(val => {
                if(!data[val]){
                    $(`#${val}`).append(`<tbody><tr><td colspan="100%">No fetched data.</td></tr></tbody>`)
                }else{
                    $(`#${val}`).append(`<tbody>${data[val]}</tbody>`)
                }
                
            })
        },
        error: function(data){
            console.log(data);
        }
    })
 })


</script>
</body>
</html>
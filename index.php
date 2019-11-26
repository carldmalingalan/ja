<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>J&A Charts and Reporting</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
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

        a {
            text-decoration: none;
            cursor: pointer;
            color: #00A  !important;
        }
        a:hover {
            color: white !important;
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
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5>Service</h5>
                    <h3 id="ServiceNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                </div>
            </div>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5>Employee</h5>
                    <h3 id="EmployeeNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                </div>
            </div>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5 >Product</h5>
                    <h3 id="ProductNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                </div>
            </div>
        </div>
            <div class="custom-col col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-body" style="display: flex;">
                    <h5>Restock</h5>
                    <h3 id="OutOfStockNo" style="margin:0;padding:0; margin-left: 50%;"></h3>
                </div>
            </div>
                <!-- <div class="card">
                <p class="h4 text-center mt-2">Custom Sales Report</p>
                    <form action="" class="from-inline" method="POST">
                        <div class="form-group  mx-sm-3 mb-2">
                            <div class="row">
                            <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                            <input type="text" class="form-control form-control-sm"  name="single_report" id="single_report" placeholder="Enter single date" >
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <button type="submit"  class="btn btn-sm btn-outline-success float-right">Generate</button>
                            </div>
                            </div>
                        </div>
                    </form>

                    <form action="" class="from-inline" method="POST">
                        <div class="form-group  mx-sm-3 mb-2">
                            <div class="row">
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                            <input type="text" class="form-control form-control-sm"  name="multi_report" id="single_report" placeholder="Enter single date" >
                            </div>
                            <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                            <input type="text" class="form-control form-control-sm"  name="multi_report" id="single_report" placeholder="Enter single date" >
                            </div>
                            <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                            <button type="submit" class="btn btn-sm btn-outline-success float-right">Generate</button>
                            </div>
                            </div>                                                                                    
                        </div>
                    </form>
                </div> -->
            </div>
            <div class="custom-col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
            <div class="card-body text-center">
                <div id="sales-annual" style="height: 300px; width: 100%;"></div>
                <a target="_blank" href="print/print_sales_annual.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
            
        </div>
            </div>
            <div class="custom-col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
            <div class="card-body text-center">
            <div id="sales-monthly" style="height: 300px; width: 100%;"></div>
            <a target="_blank" href="print/print_sales_month.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
        </div>
            </div>
            <div class="custom-col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
            <div class="card-body text-center">
            <div id="sales-weekly" style="height: 300px; width: 100%;"></div>
            <a target="_blank" href="print/print_sales_week.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
        </div>
            </div>
            <div class="custom-col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
            <div class="card-body text-center">
                <div id="employee-service-ranking" style="height: 300px; width: 100%;"></div>
                <a target="_blank" href="print/print_employee_service.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
            
        </div>
            </div>
            <div class="custom-col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
            <div class="card-body text-center">
                <div id="employee-profit-ranking" style="height: 300px; width: 100%;"></div>
                <a target="_blank" href="print/print_employee_income.php/?id=<?php echo $_GET["id"];?>" class="btn btn-sm btn-outline-primary mt-2" data-toggle="tooltip" title="Print as PDF" data-placement="top">Print</a>
            </div>
        </div>
        </div>
        <div class="custom-col col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
            <div class="card-body text-center">
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
            <div class="card-body text-center">
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
            <div class="card-body text-center">
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
            <div class="card-body text-center">
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="canvasjs-2.3.2/canvasjs.min.js"></script>
<script src="momentjs/moment.js"></script>

<script>
$(document).ready(function(){ 

    $('[data-toggle="tooltip"]').tooltip();


    let annualData = [], monthlyData = [], weeklyData = [], service = [], profit = [];

let monthly =   new CanvasJS.Chart("sales-monthly", {
	animationEnabled: true,
	title:{
		text: `Sales Report - Monthly (${moment().format("YYYY")})`
	},
	axisX:{
		valueFormatString: "MMM"
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
        itemclick: monthlyLegendChange
    },
    data: monthlyData
})

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

let weekly = new CanvasJS.Chart("sales-weekly", {
	animationEnabled: true,
	title:{
		text: `Sales Report - Weekly (${moment().format("MMMM")})`
	},
	axisX:{
		valueFormatString: "Week D"
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
        itemclick: weeklyLegendChange
    },
	data: weeklyData
    });
















let serviceRank = new CanvasJS.Chart("employee-service-ranking",{animationEnabled: true,
	title:{
		text: `Employee Ranking (Per Services)`
	},
	
	axisX: {
		title: "Employee Names",
		includeZero: false
	},
    toolTip: {
        shared: true
    },
    legend: {
        cursor: "pointer",
        itemclick: EmpServLegendChange
    },
    data: service});

let profitRank = new CanvasJS.Chart("employee-profit-ranking",{animationEnabled: true,
	title:{
		text: `Employee Ranking (Per Income)`
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
function monthlyLegendChange(e){
    if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
        e.dataSeries["toolTipContent"] = null;
	}
	else {
		e.dataSeries.visible = true;            
        delete e.dataSeries["toolTipContent"] || "";
	}
    monthly.render();
}


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


function weeklyLegendChange(e){
    if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
        e.dataSeries["toolTipContent"] = null;
	}
	else {
		e.dataSeries.visible = true;            
        delete e.dataSeries["toolTipContent"] || "";
	}
    weekly.render();
}

function EmpServLegendChange(e){
    if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
        e.dataSeries["toolTipContent"] = null;
	}
	else {
		e.dataSeries.visible = true;            
        delete e.dataSeries["toolTipContent"] || "";
	}
    serviceRank.render();
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
        url: "ajax/monthly_sales.php",
        dataType: "JSON",
        global: true,
        success:function(data) {
            let finalData = data.map(m2Val => ({ ...m2Val, dataPoints: m2Val.dataPoints.map(mVal => ({...mVal, x: new Date(mVal.x[0], mVal.x[1], mVal.x[2])})) }))
            monthlyData.push(...finalData);
            monthly.render();
            
        },
        error: function(data){
            console.log(data)
        }
    })
    $.ajax({
        url: "ajax/weekly_sales.php",
        dataType: "JSON",
        success:function(data) {
            let finalData = data.map(m2Val => ({ ...m2Val, dataPoints: m2Val.dataPoints.map(mVal => ({...mVal, x: new Date(mVal.x[0], mVal.x[1], mVal.x[2])})) }))
            weeklyData.push(...finalData);
            weekly.render();
        },
        error: function(data){
            console.log(data)
        }
    })

    $.ajax({
        url: "ajax/employee_ranking_service.php",
        dataType: "JSON",
        success:function(data) {
            service.push(...data);
            serviceRank.render();
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
            console.log(data);
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
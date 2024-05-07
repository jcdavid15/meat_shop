<?php
session_start();
if(empty($_SESSION["admin_id"])){
  header('Location:logout.php');
}
require_once("../backend/config/config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Meat Shop</title>
    <link href="../styles/bootstrap5-min.css" rel="stylesheet" />
    <link href="../styles/card-general.css" rel="stylesheet" />
    <script
      src="../scripts/font-awesome.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body class="sb-nav-fixed">
    <!-- Navbar -->
    <?php require_once("./navbar.php"); ?>
    <!-- Sidebar -->
    <div id="layoutSidenav">
      <?php require_once("./sidebar.php"); ?>
      <!-- Content -->
      <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
              <!-- Page indicator -->
              <h1 class="mt-4">Admin, </h1>
              <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>

              <div class="row">
            
            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                  Total Sales
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'>100</span>
              </div>
            </div>

            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                  Order Claimed
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'>100</span>
              </div>
            </div>

            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                  Pending Orders
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'>100</span>
              </div>
            </div>

            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                  To Claimed
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'>100</span>
              </div>
            </div>


                
                
                
                
            </div>
              <div class="row">
                <div class="col-md m-1">
                  <div class="card">
                    <div class="card-header bg-secondary pt-3">
                      <div class="text-center">
                        <p class="card-title text-light">Account Counts</p>
                      </div>
                    </div>
                    <div class="card-body">
                        <?php
                          // Secretary
                          $secretaryCount = mysqli_query($conn, "SELECT COUNT(role_id) AS secRoleCount FROM tbl_account WHERE role_id = 1;");
                          $count1 = mysqli_fetch_assoc($secretaryCount);
                          $countOfSecretary = $count1['secRoleCount'];
                          // Captain
                          $brgyCaptCount = mysqli_query($conn, "SELECT COUNT(role_id) AS captRoleCount FROM tbl_account WHERE role_id = 2;");
                          $count2 = mysqli_fetch_assoc($brgyCaptCount);
                          $countOfBrgyCapt = $count2['captRoleCount'];
                          // Cashier
                          $cashierCount = mysqli_query($conn, "SELECT COUNT(role_id) AS cashierRoleCount FROM tbl_account WHERE role_id = 3;");
                          $count3 = mysqli_fetch_assoc($cashierCount);
                          $countOfCashier = $count3['cashierRoleCount'];
                          ?>
                        <canvas id="employeePerRoleCount"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
                        </canvas>
                    </div>

                  </div>
                </div>
                <div class="col-md m-1">
                  <div class="card" style="height:500px; overflow: auto;">
                    <div class="text-center mt-3">
                            <p class="card-title">Available Request</p>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                              <th>Product Id</th>
                              <th>Product Name</th>
                              <th>Product Price</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM tbl_products"; 
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($data = $result->fetch_assoc()) {
                        ?>
                          <tr>
                            <td><?php echo $data['prod_id'];?></td>
                            <td><?php echo $data['prod_name'];?></td>
                            <td><?php echo $data['prod_price'];?></td>
                          </tr>
                        <?php 
                            }
                        ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- Barangay Clearance Start of graph -->
                <div class="col-md m-1">
                  <div class="card">
                    <div class="card-header bg-primary pt-3">
                      <div class="text-center">
                          <p class="card-title text-light">Claimed Orders</p>
                      </div>
                    </div>
                    <div class="card-header text-center d-flex justify-content-center flex-wrap" style="gap: 10px;">
                      <div class="d-flex flex-column">
                          <p>Start date</p>
                          <input
                              onchange="filterData(reqbcstartdate, reqbcenddate, chartBcRequest, serviceRequestBcCount, monthlyBcHold, configRequestBc, dataBcReq)"
                              type="month" id="reqbcstartdate">
                      </div>
                      <div class="d-flex flex-column">
                          <p>End date</p>
                          <input
                              onchange="filterData(reqbcstartdate, reqbcenddate, chartBcRequest, serviceRequestBcCount, monthlyBcHold, configRequestBc, dataBcReq)"
                              type="month" id="reqbcenddate">
                      </div>
                    </div>
                    <div class="card-body">
                        <?php
                        date_default_timezone_set('Asia/Manila');
                        $monthlyBcRequest = mysqli_query($conn, "SELECT COUNT(*) AS serviceRequestBcCount, DATE_FORMAT(order_date, '%M %Y') AS Dates FROM tbl_cart WHERE status_id = 2 AND (order_date IS NOT NULL AND order_date != '0000-00-00') GROUP BY DATE_FORMAT(order_date, '%Y-%m')");
                        foreach($monthlyBcRequest as $data)
                        {
                            $monthlyBc[] = $data['Dates'];
                            $serviceRequestBcCount[] = $data['serviceRequestBcCount'];
                        }
                        ?>
                        <div>
                          <canvas id="chartBcRequest"></canvas>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- Barangay Clerance End of graph -->
                <!-- Certificate of Indigency Start of graph -->
                <div class="col-md m-1">
                  <div class="card">
                    <div class="card-header bg-primary pt-3">
                      <div class="text-center">
                          <p class="card-title text-light">Pending Orders</p>
                      </div>
                    </div>
                    <div class="card-header text-center d-flex justify-content-center flex-wrap" style="gap: 10px;">
                      <div class="d-flex flex-column">
                          <p>Start date</p>
                          <input
                              onchange="filterData(reqcoistartdate, reqcoienddate, chartCoiRequest, serviceRequestCoiCount, monthlyCoiHold, configRequestCoi, dataCoiReq)"
                              type="month" id="reqcoistartdate">
                      </div>
                      <div class="d-flex flex-column">
                          <p>End date</p>
                          <input
                              onchange="filterData(reqcoistartdate, reqcoienddate, chartCoiRequest, serviceRequestCoiCount, monthlyCoiHold, configRequestCoi, dataCoiReq)"
                              type="month" id="reqcoienddate">
                      </div>
                    </div>
                    <div class="card-body">
                        <?php
                        date_default_timezone_set('Asia/Manila');
                        $monthlyCoiRequest = mysqli_query($conn, "SELECT COUNT(*) AS serviceRequestCoiCount, DATE_FORMAT(order_date, '%M %Y') AS Dates FROM tbl_cart WHERE status_id = 4 AND (order_date IS NOT NULL AND order_date != '0000-00-00') GROUP BY DATE_FORMAT(order_date, '%Y-%m')");
                        foreach($monthlyCoiRequest as $data)
                        {
                            $monthlyCoi[] = $data['Dates'];
                            $serviceRequestCoiCount[] = $data['serviceRequestCoiCount'];
                        }
                        ?>
                        <div>
                          <canvas id="chartCoiRequest"></canvas>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- Certificate of Indigency End of graph -->
            </div>
          </div>
        </main>
      </div>
    </div>
    <script
      src="../scripts/bootstrap.bundle.min.js"
    ></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/toggle.js"></script>
    <!-- ChartJS -->
    <script src="../scripts/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                      
  <script>
  // Note: Barangay Clearance Request Variables
  const monthlyBc = <?php echo json_encode($monthlyBc);?>;
  const serviceRequestBcCount = <?php echo json_encode($serviceRequestBcCount);?>;
  const monthlyBcHold = [...monthlyBc];
  const serviceRequestBcCountHold = [...serviceRequestBcCount];
  // Note: Certificate of Indigency Request Variables
  const monthlyCoi = <?php echo json_encode($monthlyCoi);?>;
  const serviceRequestCoiCount = <?php echo json_encode($serviceRequestCoiCount);?>;
  const monthlyCoiHold = [...monthlyCoi];
  const serviceRequestCoiCountHold = [...serviceRequestCoiCount];

  // Note: Request Maps
  const dateMaps = new Map([
        [1, 'January'],
        [2, 'February'],
        [3, 'March'],
        [4, 'April'],
        [5, 'May'],
        [6, 'June'],
        [7, 'July'],
        [8, 'August'],
        [9, 'September'],
        [10, 'October'],
        [11, 'November'],
        [12, 'December']
  ]);

  // Note: Barangay Clearance Request Data
  const dataBcReq = {
        labels: monthlyBc,
        datasets: [{
            label: 'Request Count Monthly',
            data: serviceRequestBcCount,
            backgroundColor: [
                'rgba(255, 26, 104, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(0, 0, 0, 0.2)'
            ],
            borderColor: [
                'rgba(255, 26, 104, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1
        }]
    };
    // Note: Certificate of Indigency Request Data
    const dataCoiReq = {
        labels: monthlyCoi,
        datasets: [{
            label: 'Request Count Monthly',
            data: serviceRequestCoiCount,
            backgroundColor: [
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(0, 0, 0, 0.2)',
              'rgba(255, 26, 104, 0.2)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(0, 0, 0, 1)',
              'rgba(255, 26, 104, 1)'
            ],
            borderWidth: 1
        }]
    };
    // Note: Barangay Id Request Data
    const dataBiReq = {
        labels: monthlyBi,
        datasets: [{
            label: 'Request Count Monthly',
            data: serviceRequestBiCount,
            backgroundColor: [
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(0, 0, 0, 0.2)',
              'rgba(255, 26, 104, 0.2)',
              'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(0, 0, 0, 1)',
              'rgba(255, 26, 104, 1)',
              'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    };
    // Note: Business Permit Request Data
    const dataBpReq = {
        labels: monthlyBp,
        datasets: [{
            label: 'Request Count Monthly',
            data: serviceRequestBpCount,
            backgroundColor: [
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(0, 0, 0, 0.2)',
              'rgba(255, 26, 104, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(0, 0, 0, 1)',
              'rgba(255, 26, 104, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Note: Barangay Clearance Request Config
    const configRequestBc = {
        type: 'bar',
        data: dataBcReq,
        options: {
            scale: {
                ticks: {
                    precision: 0
                },
                y: {
                    suggestedMin: 0,
                    suggestedMax: 30
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };
    // Note: Certificate of Indigency Request Config
    const configRequestCoi = {
        type: 'bar',
        data: dataCoiReq,
        options: {
            scale: {
                ticks: {
                    precision: 0
                },
                y: {
                    suggestedMin: 0,
                    suggestedMax: 30
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };
    // Note: Barangay Id Request Config
    const configRequestBi = {
        type: 'bar',
        data: dataBiReq,
        options: {
            scale: {
                ticks: {
                    precision: 0
                },
                y: {
                    suggestedMin: 0,
                    suggestedMax: 30
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };

    // Note: Business Permit Request Config
    const configRequestBp = {
        type: 'bar',
        data: dataBpReq,
        options: {
            scale: {
                ticks: {
                    precision: 0
                },
                y: {
                    suggestedMin: 0,
                    suggestedMax: 30
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };

    // Note: Barangay Clearance Request Chart
    const chartBcRequest = new Chart(
        document.getElementById('chartBcRequest'),
        configRequestBc
    );

    // Note: Certificate of Indigency Request Chart
    const chartCoiRequest = new Chart(
        document.getElementById('chartCoiRequest'),
        configRequestCoi
    );

    // Note: Barangay Id Request Chart
    const chartBiRequest = new Chart(
        document.getElementById('chartBiRequest'),
        configRequestBi
    );

    // Note: Barangay Id Request Chart
    const chartBpRequest = new Chart(
        document.getElementById('chartBpRequest'),
        configRequestBp
    );

    // Note: Request Filtering
    function filterData(start, end, chart, datapoint2, month2, config, dataConfig) {
        let dateArrStart = start.value.split('-'); //array 1: Year - 2: Month
        let dateArrEnd = end.value.split('-');

        if (dateArrEnd != '') {
            // get index in array
            const indexstartdate = month2.indexOf(`${dateMaps.get(Number(dateArrStart[1]))} ${dateArrStart[0]}`);
            const indexenddate = month2.indexOf(`${dateMaps.get(Number(dateArrEnd[1]))} ${dateArrEnd[0]}`);

            const monthPlaceHolderLabel = [];

            // NOTE: Date Label
            for (let x = Number(dateArrStart[1]); x <= Number(dateArrEnd[1]); x++) {
                monthPlaceHolderLabel.push(`${dateMaps.get(x)} ${dateArrStart[0]}`);
            }

            const filterDateLabel = monthPlaceHolderLabel.filter((val, i) => {
                for (const valMonth2 of month2) {
                    if (valMonth2 === val) {
                        if (i >= 1) {
                            return val;
                        } else {
                            return val;
                        }
                    }
                }
            })

            chart.config.data.labels = filterDateLabel;
            chart.update();

            const filterDatePoints = datapoint2.slice(month2.indexOf(filterDateLabel[0]));
            chart.config.data.datasets[0].data = filterDatePoints;
            chart.update();
        }
    }
</script>

<!-- Employee per role counter -->
<script>
    $(function() {
        var pieChartCanvas = $('#employeePerRoleCount').get(0).getContext('2d')
        var donutData = {
            labels: ['User', 'Admin', 'Cashier'],
            datasets: [{
                data: [<?php echo $countOfSecretary;?>, <?php echo $countOfBrgyCapt;?>,
                    <?php echo $countOfCashier;?>
                ],
                backgroundColor: ['#00d4ff', '#fd1d1d', '#eeaeca'],
            }]
        }
        var pieData = donutData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
    })
    </script>

  </body>
</html>

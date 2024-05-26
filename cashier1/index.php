<?php
session_start();
if(empty($_SESSION["cashier_id"])){
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
    <title>Cashier Panel</title>
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
              <h1 class="mt-4" id='full_name'>Admin, </h1>
              <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>

              <div class="row">
            
            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                <?php
                  $query5 = "SELECT SUM(tp.prod_price * tc.prod_qnty) AS total_sales FROM tbl_cart tc 
                  INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id
                  WHERE tc.status_id = 2 AND tc.branch_id = 1;";
                  $stmt5 = $conn->prepare($query5);
                  $stmt5->execute();
                  $result5 = $stmt5->get_result();
                  $data5 = $result5->fetch_assoc();
                ?>
                  Total Sales
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'><?php echo $data5["total_sales"] != 0 ? $data5["total_sales"] : "0"; ?></span>
              </div>
            </div>

            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                <?php
                  $query6 = "SELECT COUNT(item_id) AS total_claimed FROM tbl_cart WHERE status_id = 2 and branch_id = 1";
                  $stmt6 = $conn->prepare($query6);
                  $stmt6->execute();
                  $result6 = $stmt6->get_result();
                  $data6 = $result6->fetch_assoc();
                ?>
                  Order Claimed
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'><?php echo $data6["total_claimed"] ?></span>
              </div>
            </div>

            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                <?php
                  $query7 = "SELECT COUNT(item_id) AS total_pending FROM tbl_cart WHERE status_id = 3 and branch_id = 1";
                  $stmt7 = $conn->prepare($query7);
                  $stmt7->execute();
                  $result7 = $stmt7->get_result();
                  $data7 = $result7->fetch_assoc();
                ?>
                  Pending Orders
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'><?php echo $data7["total_pending"] != 0 ? $data7["total_pending"] : "0"; ?></span>
              </div>
            </div>

            <div class="c-dashboardInfo col-xl-3 col-md-6">
              <div class="wrap">
                <h4
                  class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title"
                >
                <?php
                  $query8 = "SELECT COUNT(item_id) AS total_claim FROM tbl_cart WHERE status_id = 4 and branch_id = 1";
                  $stmt8 = $conn->prepare($query8);
                  $stmt8->execute();
                  $result8 = $stmt8->get_result();
                  $data8 = $result8->fetch_assoc();
                ?>
                  To Claimed
                </h4>
                <span class='hind-font caption-12 c-dashboardInfo__count'><?php echo $data8["total_claim"] ?></span>
              </div>
            </div>
</div>

<script src="../scripts/bootstrap.bundle.min.js"></script>
<script src="../scripts/jquery.js"></script>
<script src="../scripts/toggle.js"></script>

<script>
    const full_name = document.getElementById('full_name');
    const acc_data = JSON.parse(localStorage.getItem('cashierDetails'));
    full_name.innerText = 'Cashier, ' + acc_data.full_name;
</script>


  </body>
</html>
 
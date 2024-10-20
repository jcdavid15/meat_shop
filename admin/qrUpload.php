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
    <title>Admin Panel</title>
    <!-- DataTables -->
    <link href="../plugins/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../plugins/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="../styles/bootstrap5-min.css" rel="stylesheet" />
    <link href="../styles/card-general.css" rel="stylesheet" />
    <script src="../scripts/sweetalert2.js"></script>
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
            <h1 class="mt-4" id="full_name">Admin,</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Payment QR Code</li>
            </ol>

                <div class="card mb-5">
                    <div class="card-header bg-primary pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">Modify QR <i class="fas fa-plus"></i></p>
                        </div>
                    </div>
                    <div class="card-body">
                    <form class="row g-3" method="post" id="addProd">
                            <div class="col-md-4">
                                <label for="prod_img" class="form-label">Qr Image</label>
                                <input type="file" class="form-control" id="prod_img">
                            </div>
                            <div class="col-12 text-center mb-4 mt-5">
                                <button type="submit" id="submit" class="btn btn-primary btn-lg">Update Qr Code</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
      </main>
    </div>
  </div>

<script>
function validateNumberInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}
</script>
  <script
      src="../scripts/bootstrap.bundle.min.js"
    ></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/toggle.js"></script>
    <script src="../jquery/modifyQr.js"></script>
    <!-- DataTables Scripts -->
    <script src="../plugins/js/jquery.dataTables.min.js"></script>
    <script src="../plugins/js/dataTables.bootstrap5.min.js"></script>
    <script src="../plugins/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/js/responsive.bootstrap5.min.js"></script>



<script>
    const full_name = document.getElementById('full_name');
    const acc_data = JSON.parse(localStorage.getItem('adminDetails'))
    full_name.innerText = 'Admin, ' + acc_data.full_name;
  </script> 
<script src="../jquery/sideBarProd.js"></script> 
  </body>
</html>

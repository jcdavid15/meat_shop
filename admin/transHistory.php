<?php
session_start();
if(empty($_SESSION["admin_id"])){
  header('Location:logout.php');
  exit();
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
              <li class="breadcrumb-item active">Sales</li>
            </ol>

              <div class="card mb-5">
                    <div class="card-header bg-primary pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">All Transactions
                        </div>
                    </div>
                    <div class="card-body">
                      <table id="userAuditLogs" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>User Activty</th>
                            <th>User Type</th>
                            <th>Log Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $query = "SELECT ts.*, tr.role_name FROM tbl_transactions ts 
                            INNER JOIN tbl_role tr ON tr.role_id = ts.user_type";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                              while ($data = $result->fetch_assoc()) {
                                $dateObject = new DateTime($data["activity_date"]);
                          ?>
                          <tr>
                            <td><?php echo $data['user_id'];?></td>
                            <td><?php echo $data['user_name'];?></td>
                            <td><?php echo $data['role_name'];?></td>
                            <td><?php echo $data['user_activity'];?></td>
                            <td><?php echo $dateObject->format('F j, Y'); ?></td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
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
    <!-- DataTables Scripts -->
    <script src="../plugins/js/jquery.dataTables.min.js"></script>
    <script src="../plugins/js/dataTables.bootstrap5.min.js"></script>
    <script src="../plugins/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/js/responsive.bootstrap5.min.js"></script>

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="../styles/dataTables.min.css">

    <!-- DataTables Buttons JavaScript -->
    <script src="../scripts/dataTables.js"></script>
    <script src="../scripts/ajax.make.min.js"></script>
    <script src="../scripts/ajax.fonts.js"></script>
    <script src="../scripts/dtBtn.html5.js"></script>
    <script>
        function convertToLowercase(input) {
            input.value = input.value.toLowerCase();
        }
    </script>

<script>
      $(document).ready(function() {
          $('#userAuditLogs').DataTable({
              responsive: true,
              order: [[3, 'desc']],
              dom: 'Bfrtip',
              buttons: [
            {
                extend: 'csvHtml5',
                text: '<i class="fa-solid fa-file-csv fa-2xl" style="color: #1e7b64;"></i>',
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa-solid fa-file-pdf fa-2xl" style="color: #a01818;"></i> ',
            }
        ]
          });
      });
</script>

<script>
    const full_name = document.getElementById('full_name');
    const acc_data = JSON.parse(localStorage.getItem('adminDetails'))
    full_name.innerText = 'Admin, ' + acc_data.full_name;
  </script>  
<script src="../jquery/sideBarProd.js"></script>
  </body>
</html>

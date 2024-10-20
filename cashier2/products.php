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
    <title>Cashier</title>
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
    <style>
      .stock-indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-left: 10px;
      }
    </style>
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
            <h1 class="mt-4" id="full_name">Cashier Panel</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Products</li>
            </ol>

              <div class="card mb-5">
                    <div class="card-header bg-primary pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">List Products
                        </div>
                    </div>
                    <div class="card-body">
                      <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Product Id</th>
                              <th>Product Name</th>
                              <th>Product Price</th>
                              <th>Product Stocks</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if(isset($_SESSION["cashier_id"])){
                              $cashierId = $_SESSION["cashier_id"];
                              $query = "SELECT account_id, branch_id FROM tbl_account WHERE account_id = ?";
                              $stmt = $conn->prepare($query);
                              $stmt->bind_param("i", $cashierId);
                              $stmt->execute();
                              $result = $stmt->get_result();
                              $data = $result->fetch_assoc();
                              $branchId = $data["branch_id"];

                            }
                          ?>
                          <?php
                            if(isset($_GET['type'])){
                                $prodId = intval($_GET["type"]);
                                $query = "SELECT * FROM tbl_products WHERE prod_type = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("i", $prodId);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($data = $result->fetch_assoc()) {
                          ?>
                          <tr class="product-row" data-prod-id="<?php echo $data['prod_id']; ?>" data-prod-name="<?php echo $data['prod_name']; ?>" data-prod-stocks="<?php echo $data['prod_stocks']; ?>">
                              <td><?php echo $data['prod_id']; ?></td>
                              <td><?php echo $data['prod_name']; ?></td>
                              <td>₱<?php echo number_format($data['prod_price'], 2); ?>/Kg</td>
                              <td>
                                  <?php echo $data['prod_stocks']; ?>Kg
                                  <span class="stock-indicator" style="background-color: <?php echo $data['prod_stocks'] < 10 ? 'red' : 'green'; ?>;"></span>
                              </td>
                              <td>
                                  <button type="button" class="btn btn-primary" id="<?php echo $data["prod_id"] ?>" data-bs-toggle="modal" data-bs-target="#residenceAccountDetails<?php echo $data["prod_id"] ?>" data-bs-whatever="@getbootstrap">
                                      <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                  </button>
                              </td>
                          </tr>
                            <div class="modal fade" id="residenceAccountDetails<?php echo $data["prod_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <form method="post">
                                    <div class="mb-3">
                                      <label class="col-form-label">Product Name</label>
                                      <input type="text" class="form-control updatedName" value="<?php echo $data["prod_name"]; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                      <label class="col-form-label">Product Price</label>
                                      <input type="text" class="form-control updatedPrice" value="<?php echo $data["prod_price"]; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                      <label class="col-form-label">Product Stocks</label>
                                      <input type="text" class="form-control stocks" value="<?php echo $data["prod_stocks"]; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                      <label class="col-form-label">Quantity</label>
                                      <input type="number" class="form-control qnty" min="0.5">
                                    </div>
                                  </form>
                                  </div>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-primary btn-accept updateResBtn" value="<?php echo $data["prod_id"] ?>" data-branch-id=<?php echo $branchId ?>>
                                      Order Now
                                  </button>
                                    <button type="button" class="btn btn-secondary " value="<?php echo $data["prod_id"]; ?>" data-bs-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php
                            } }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
            </div>
      </main>
    </div>
  </div>
  <script>

document.querySelectorAll('.product-row').forEach(function(row) {
    // Access data attributes using getAttribute or dataset in vanilla JS
    var stocks = row.getAttribute('data-prod-stocks');
    var prodName = row.getAttribute('data-prod-name');
    
    // Convert stocks to a number for comparison
    stocks = parseFloat(stocks);
    
    if (stocks < 10) {
        Swal.fire({
            title: 'Low Stock Alert!',
            text: prodName + ' has low stocks (' + stocks + 'Kg).',
            icon: 'warning',
            confirmButtonText: 'Okay'
        });
    }
});

  </script>
  <script src="../scripts/bootstrap.bundle.min.js"></script>
  <script src="../scripts/jquery.js"></script>
  <script src="../scripts/toggle.js"></script>
  <script src="../jquery/cashierOrder.js"></script>
  <!-- DataTables Scripts -->
  <script src="../plugins/js/jquery.dataTables.min.js"></script>
  <script src="../plugins/js/dataTables.bootstrap5.min.js"></script>
  <script src="../plugins/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/js/responsive.bootstrap5.min.js"></script>
  <!-- DataTables Buttons JavaScript -->
  <script src="../scripts/dataTables.js"></script>
  <script src="../scripts/ajax.make.min.js"></script>
  <script src="../scripts/ajax.fonts.js"></script>
  <script src="../scripts/dtBtn.html5.js"></script>
  <script src="../jquery/sideBarProd.js"></script>
</body>
</html>

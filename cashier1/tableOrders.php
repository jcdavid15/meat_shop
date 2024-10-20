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
            <h1 class="mt-4" id="full_name">Cashier,</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Sales</li>
            </ol>
                  <div class="card mb-5">
                    <div class="card-header bg-info pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">Bagbag Branch Receipt Orders
                        </div>
                    </div>
                    <div class="card-body">
                      <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Order Id</th>
                              <th>Customer Name</th>
                              <th>Reference No.</th>
                              <th>Uploaded Date</th>
                              <th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $query = "SELECT tr.*, CONCAT(td.first_name, ' ', td.middle_name, ' ', td.last_name) as full_name,
                            td.address, td.contact
                            FROM tbl_receipt tr
                            INNER JOIN tbl_account_details td ON td.account_id = tr.account_id
                            WHERE tr.branch_id = 1;";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                              while ($data = $result->fetch_assoc()) {
                                $dateObject = new DateTime($data["uploaded_date"]);
                                $formattedDate = $dateObject->format('M j, Y');
                          ?>
                          <tr>
                            <td><?php echo $data['receipt_id'];?></td>
                            <td><?php echo $data['full_name'];?></td>
                            <td><?php echo $data["receipt_number"]; ?></td>
                            <td><?php echo $formattedDate; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" id="<?php echo $data["receipt_id"] ?>"  data-bs-toggle="modal" 
                                data-bs-target="#receiptDetails<?php echo $data["receipt_id"] ?>" data-bs-whatever="@getbootstrap">
                                  <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                </button>
                            </td>
                          </tr>
                            <div class="modal fade" id="receiptDetails<?php echo $data["receipt_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <form method="post">
                                    <div class="mb-3">
                                      <label class="col-form-label">Customer Deposited</label>
                                      <input type="text" class="form-control updatedName" value="<?php echo $data["deposit_amount"]; ?>" disabled >
                                    </div>
                                    <div class="mb-3">
                                      <label class="col-form-label">Customer Reference Number</label>
                                      <input type="text" class="form-control updatedName" value="<?php echo $data["receipt_number"]; ?>" disabled >
                                    </div>
                                    <div class="mb-3">
                                      <label class="col-form-label">Customer Name</label>
                                      <input type="text" class="form-control updatedName" value="<?php echo $data["full_name"]; ?>" disabled >
                                    </div>
                                    <div class="mb-3">
                                      <label class="col-form-label">Customer Address</label>
                                      <input type="text" class="form-control updatedName" value="<?php echo $data["address"]; ?>" disabled >
                                    </div>
                                    <div class="mb-3">
                                      <label class="col-form-label">Customer Contact</label>
                                      <input type="text" class="form-control updatedName" value="<?php echo $data["contact"]; ?>" disabled >
                                    </div>
                                    <div>
                                      <label class="col-form-label">Image Receipt:</label>
                                      <div class="img-con" style="width: 250px;">
                                        <img src="../backend/receipts/<?php echo $data["receipt_img"]; ?>" alt=""
                                        style="width: 250px;">
                                      </div>
                                    </div>
                                      
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                  <!-- <button type="button" class="btn btn-primary btn-accept updateResBtn" value="<?php echo $data["receipt_id"] ?>" >
                                      Save
                                  </button> -->
                                    <button type="button" class="btn btn-secondary " value="<?php echo $data["receipt_id"]; ?>" data-bs-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>


                  <div class="card mb-5">
                    <div class="card-header bg-secondary pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">Bagbag Branch Pending Orders
                        </div>
                    </div>
                    <div class="card-body">
                      <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Custmer Id</th>
                              <th>Customer Name</th>
                              <th>Customer Contact</th>
                              <th>Customer Address</th>
                              <th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT DISTINCT CONCAT(ta.first_name, ' ', ta.middle_name, ' ', ta.last_name) AS full_name,
                                        ta.contact, ta.address, ta.account_id, tb.branch_name 
                                    FROM tbl_cart tc
                                    INNER JOIN tbl_account tba ON tba.account_id = tc.account_id
                                    INNER JOIN tbl_account_details ta ON ta.account_id = tba.account_id
                                    INNER JOIN tbl_branch tb ON tb.branch_id = tc.branch_id
                                    WHERE tb.branch_id = 1 AND tc.status_id = 3";

                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($data = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $data['account_id']; ?></td>
                                <td><?php echo $data['full_name']; ?></td>
                                <td><?php echo $data['contact']; ?></td>
                                <td><?php echo $data['address']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" id="modalButton<?php echo $data['account_id']; ?>" data-bs-toggle="modal" 
                                            data-bs-target="#residenceAccountDetails<?php echo $data['account_id']; ?>" data-bs-whatever="@getbootstrap">
                                        <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal for this customer -->
                            <div class="modal fade" id="residenceAccountDetails<?php echo $data['account_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Order Details for <?php echo $data['full_name']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $query2 = "SELECT tc.item_id, tc.account_id, tc.prod_id, tc.prod_qnty, 
                                                                tp.prod_name, tp.prod_price, 
                                                                CONCAT(ta.first_name, ' ', ta.middle_name, ' ', ta.last_name) AS full_name,
                                                                ta.contact, ta.address, tb.branch_name 
                                                        FROM tbl_cart tc 
                                                        INNER JOIN tbl_products tp ON tp.prod_id = tc.prod_id 
                                                        INNER JOIN tbl_branch tb ON tc.branch_id = tb.branch_id 
                                                        INNER JOIN tbl_account_details ta ON ta.account_id = tc.account_id 
                                                        WHERE tb.branch_id = 1 AND tc.status_id = 3 AND tc.account_id = ?";
                                            
                                            $stmt2 = $conn->prepare($query2);
                                            $stmt2->bind_param('i', $data['account_id']);  // Bind account_id to only show relevant order details
                                            $stmt2->execute();
                                            $result2 = $stmt2->get_result();
                                            
                                            while ($order = $result2->fetch_assoc()) {
                                                $total = $order['prod_qnty'] * $order['prod_price'];
                                            ?>
                                                <form method="post">
                                                    <div class="mb-3">
                                                        <label class="col-form-label border-top border-3 border-danger"><strong>Order Name</strong></label>
                                                        <input type="text" class="form-control" value="<?php echo $order['prod_name']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Order Price</label>
                                                        <input type="text" class="form-control" value="<?php echo $order['prod_price']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Order Quantity</label>
                                                        <input type="text" class="form-control" value="<?php echo $order['prod_qnty']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Total</label>
                                                        <input type="text" class="form-control" value="<?php echo $total; ?>" disabled>
                                                    </div>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary updateBtn" data-account-id="<?php echo $data["account_id"] ?>">Accept</button>
                                            <button type="button" class="btn btn-danger declineBtn" data-account-id="<?php echo $data["account_id"] ?>">Decline</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            </tbody>


                      </table>
                    </div>
                  </div>

                  
                  <div class="card mb-5">
                    <div class="card-header bg-primary pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">Bagbag Branch Pending Orders
                        </div>
                    </div>
                    <div class="card-body">
                      <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Custmer Id</th>
                              <th>Customer Name</th>
                              <th>Customer Contact</th>
                              <th>Customer Address</th>
                              <th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT DISTINCT CONCAT(ta.first_name, ' ', ta.middle_name, ' ', ta.last_name) AS full_name,
                                        ta.contact, ta.address, ta.account_id, tb.branch_name 
                                    FROM tbl_cart tc
                                    INNER JOIN tbl_account tba ON tba.account_id = tc.account_id
                                    INNER JOIN tbl_account_details ta ON ta.account_id = tba.account_id
                                    INNER JOIN tbl_branch tb ON tb.branch_id = tc.branch_id
                                    WHERE tb.branch_id = 1 AND tc.status_id = 4";

                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($data = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $data['account_id']; ?></td>
                                <td><?php echo $data['full_name']; ?></td>
                                <td><?php echo $data['contact']; ?></td>
                                <td><?php echo $data['address']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" id="modalButton<?php echo $data['account_id']; ?>" data-bs-toggle="modal" 
                                            data-bs-target="#residenceAccountDetails<?php echo $data['account_id']; ?>" data-bs-whatever="@getbootstrap">
                                        <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal for this customer -->
                            <div class="modal fade" id="residenceAccountDetails<?php echo $data['account_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Order Details for <?php echo $data['full_name']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $query2 = "SELECT tc.item_id, tc.account_id, tc.prod_id, tc.prod_qnty, 
                                                                tp.prod_name, tp.prod_price, 
                                                                CONCAT(ta.first_name, ' ', ta.middle_name, ' ', ta.last_name) AS full_name,
                                                                ta.contact, ta.address, tb.branch_name 
                                                        FROM tbl_cart tc 
                                                        INNER JOIN tbl_products tp ON tp.prod_id = tc.prod_id 
                                                        INNER JOIN tbl_branch tb ON tc.branch_id = tb.branch_id 
                                                        INNER JOIN tbl_account_details ta ON ta.account_id = tc.account_id 
                                                        WHERE tb.branch_id = 1 AND tc.status_id = 4 AND tc.account_id = ?";
                                            
                                            $stmt2 = $conn->prepare($query2);
                                            $stmt2->bind_param('i', $data['account_id']);  // Bind account_id to only show relevant order details
                                            $stmt2->execute();
                                            $result2 = $stmt2->get_result();
                                            
                                            while ($order = $result2->fetch_assoc()) {
                                                $total = $order['prod_qnty'] * $order['prod_price'];
                                            ?>
                                                <form method="post">
                                                    <div class="mb-3">
                                                        <label class="col-form-label border-top border-3 border-danger"><strong>Order Name</strong></label>
                                                        <input type="text" class="form-control" value="<?php echo $order['prod_name']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Order Price</label>
                                                        <input type="text" class="form-control" value="<?php echo $order['prod_price']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Order Quantity</label>
                                                        <input type="text" class="form-control" value="<?php echo $order['prod_qnty']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label">Total</label>
                                                        <input type="text" class="form-control" value="<?php echo $total; ?>" disabled>
                                                    </div>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary acceptBtn" data-account-id="<?php echo $data["account_id"] ?>">Accept</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script src="../jquery/updatePending.js"></script>
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
          $('#residenceAccounts').DataTable({
              responsive: true,
              order: [[0, 'desc']],
          });
      });
</script>


<script>
      $(document).ready(function() {
          $('#toClaimOrders').DataTable({
              responsive: true,
              order: [[0, 'desc']],
          });
      });
</script>

<script>
    const full_name = document.getElementById('full_name');
    const acc_data = JSON.parse(localStorage.getItem('cashierDetails'))
    full_name.innerText = 'Cashier, ' + acc_data.full_name;
  </script>  
   <script src="../jquery/sideBarProd.js"></script>
  </body>
</html>

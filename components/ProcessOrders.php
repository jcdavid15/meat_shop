<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/history.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>History</title>
</head>
<body>

    <?php include "./navbar.php" ?>

    <?php 
        if(empty($_SESSION["user_id"])){
            header("Location:./login.php");
        }
    require_once("../backend/config/config.php"); 
    $current_user = $_SESSION['user_id'];
    $claimQuery = "SELECT * FROM tbl_cart WHERE account_id = ? AND status_id = 4";
    $stmtClaim = $conn->prepare($claimQuery);
    $stmtClaim->bind_param("i", $current_user);
    $stmtClaim->execute();
    $resultClaim = $stmtClaim->get_result();
    if($resultClaim->num_rows > 0){
    ?>
    <script>
        Swal.fire({
            title: "You have item to claim!",
            text: "Please prepare the amount to be paid.",
            icon: "info"
        });
    </script>
    <?php } ?>
    <div class="center">
        <div class="h1-div">
            <h1>Orders History</h1>
            <div>
                <span>*</span><strong>Note:</strong> If you encounter issues adding an item to the cart multiple times, please consider clearing the cache or use the incognito mode.
            </div>
        </div>
    </div>
    <?php 
        $query = "SELECT tc.item_id, tc.prod_qnty, tc.branch_id, 
        pt.prod_type_name, tb.branch_name, ts.status_name, tp.* FROM tbl_cart tc
        INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id 
        INNER JOIN tbl_status ts ON tc.status_id = ts.status_id
        INNER JOIN tbl_branch tb ON tb.branch_id = tc.branch_id
        INNER JOIN tbl_product_type pt ON tp.prod_type = pt.prod_type_id
        WHERE tc.account_id = ? AND (tc.status_id = 3 OR tc.status_id = 4);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $current_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
    ?>

    <main>
        <div class="center">
            <div class="div">
                <div class="left-con">
                    <div class="cart-con">
                        <div class='pending-text'>Pending Orders</div>
                        <table class="styled-table">
                            <thead>
                                <th class='th-1'></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Branch</th>
                                <th>Status</th>
                                <th></th>
                            </thead>

                            <tbody>
                            <?php 
                            $total = 0;
                            $path = "";

                            while ($data = $result->fetch_assoc()) {
                                $total += $data["prod_price"] * $data["prod_qnty"];
                                $subtotal = $data["prod_qnty"] * $data["prod_price"];
                                $formattedTypeName = strtolower(str_replace(' ', '_', $data["prod_type_name"]));

                                // Use the function to get the quantity value dynamically
                                $qnty_value = $data["prod_qnty"];
                            ?>
                            <tr>
                                <td class="img-con"><img src="../assets/<?php echo $formattedTypeName; ?>/<?php echo $data["prod_img"]; ?>" alt=""></td>
                                <td><?php echo $data["prod_name"]; ?></td>
                                <td>₱<?php echo number_format($data["prod_price"], 2); ?></td>
                                <td>
                                    <div class="qnty-td">
                                        <div class="qnty-js"><?php echo $qnty_value; ?>Kg</div>
                                    </div>
                                </td>
                                <td class="total-price-js">₱<span class="subtotal-js"><?php echo number_format($subtotal, 2); ?></span></td>
                                <td><?php echo $data['branch_name']; ?></td>
                                <td><?php echo $data['status_name']; ?></td>
                                <td class="delete-js" id="<?php echo $data["item_id"]; ?>" data-branch-id="<?php echo $data["branch_id"]; ?>"><i class="fa-solid fa-x"></i></td>
                            </tr>
                            <?php } ?>
                        </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php }else{
    ?>
        <div class="center con-bot">
            <div class="no-item">
                <h2>No Item in your cart</h2>
                <a href="./products.php"><button>Shop now <i class="fa-solid fa-arrow-right" style="color: white;"></i></button></a>
            </div>
        </div>
    <?php } ?>
    


    <?php include "./footer.php" ?>
    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/cancelOrder.js"></script>
</body>
</html>
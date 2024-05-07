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
    ?>

    <div class="center">
        <div class="h1-div">
            <h1>Orders History</h1>
            <div>
                <span>*</span><strong>Note:</strong> If you encounter issues adding an item to the cart multiple times, please consider clearing the cache or use the incognito mode.
            </div>
        </div>
    </div>
    <?php 
        $query = "SELECT tc.prod_qnty, ts.status_name, tp.* FROM `tbl_cart` tc 
        INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id 
        INNER JOIN tbl_status ts ON tc.status_id = ts.status_id
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
                                <th>Status</th>
                                <th></th>
                            </thead>

                            <tbody>
                                <?php 
                                    $total = 0;
                                    $path = "";
                                    while($data = $result->fetch_assoc()){
                                    $total += $data["prod_price"] * $data["prod_qnty"];
                                    $subtotal = $data["prod_qnty"] * $data["prod_price"];

                                    if($data["prod_type"] == 1){
                                        $path = "beef";
                                    }else if($data["prod_type"] == 2){
                                        $path = "pork";
                                    }else if($data["prod_type"] == 3){
                                        $path = "chicken";
                                    }else if($data["prod_type"] == 4){
                                        $path = "lamb";
                                    }else if($data["prod_type"] == 5){
                                        $path = "deli_meats";
                                    }
                                ?>
                                <tr>
                                    <td class="img-con"><img src="../assets/<?php echo $path; ?>/<?php echo $data["prod_img"]; ?>" alt=""></td>
                                    <td><?php echo $data["prod_name"]; ?></td>
                                    <td>₱<?php echo $data["prod_price"]; ?>.00</td>
                                    <td>
                                        <div class="qnty-td">
                                            <!-- <div class="minus-btn">-</div>
                                        <input type="text" class="qnty-input" min="1" value="1"> -->
                                            <div class="qnty-js"><?php echo $data["prod_qnty"]; ?></div>
                                            <!-- <div class="add-btn">+</div> -->
                                        </div>
                                    </td>
                                    <td class="total-price-js">₱<span class="subtotal-js"><?php echo $subtotal; ?></span>.00</td>
                                    <td><?php echo $data['status_name']; ?></td>
                                    <td class="delete-js" id="<?php echo $data["prod_id"]; ?>"><i class="fa-solid fa-x"></i></td>
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


    <?php 
        $query1 = "SELECT tc.prod_qnty, ts.status_name, tp.* FROM `tbl_cart` tc 
        INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id 
        INNER JOIN tbl_status ts ON tc.status_id = ts.status_id
        WHERE tc.account_id = ? AND tc.status_id = 2;";
        $stmt1 = $conn->prepare($query1);
        $stmt1->bind_param("i", $current_user);
        $stmt1->execute();
        $result = $stmt1->get_result();

        if($result->num_rows > 0){
    ?>
        <div class="center">
            <div class="div">
                <div class="left-con">
                    <div class="cart-con">
                        <div class='pending-text'>Claimed Orders</div>
                        <table class="styled-table">
                            <thead>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                                <th></th>
                            </thead>

                            <tbody>
                                <?php 
                                    $total = 0;
                                    $path = "";
                                    while($data = $result->fetch_assoc()){
                                    $total += $data["prod_price"] * $data["prod_qnty"];
                                    $subtotal = $data["prod_qnty"] * $data["prod_price"];

                                    if($data["prod_type"] == 1){
                                        $path = "beef";
                                    }else if($data["prod_type"] == 2){
                                        $path = "pork";
                                    }else if($data["prod_type"] == 3){
                                        $path = "chicken";
                                    }else if($data["prod_type"] == 4){
                                        $path = "lamb";
                                    }else if($data["prod_type"] == 5){
                                        $path = "deli_meats";
                                    }
                                ?>
                                <tr>
                                    <td class="img-con"><img src="../assets/<?php echo $path; ?>/<?php echo $data["prod_img"]; ?>" alt=""></td>
                                    <td><?php echo $data["prod_name"]; ?></td>
                                    <td>₱<?php echo $data["prod_price"]; ?>.00</td>
                                    <td>
                                        <div class="qnty-td">
                                            <!-- <div class="minus-btn">-</div>
                                        <input type="text" class="qnty-input" min="1" value="1"> -->
                                            <div class="qnty-js"><?php echo $data["prod_qnty"]; ?></div>
                                            <!-- <div class="add-btn">+</div> -->
                                        </div>
                                    </td>
                                    <td class="total-price-js">₱<span class="subtotal-js"><?php echo $subtotal; ?></span>.00</td>
                                    <td><?php echo $data['status_name']; ?></td>
                                    <td></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{
    ?>
        <div class="center con-bot">
            <div class="no-item">
                <h2>No Claimed Item</h2>
            </div>
        </div>
    <?php } ?>
    


    <?php include "./footer.php" ?>
    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/deleteCartHistory.js"></script>
</body>
</html>
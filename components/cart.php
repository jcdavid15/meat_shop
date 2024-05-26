<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/cart.css">
    <script src="../jquery/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Cart</title>
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
            <h1>Cart</h1>
            <div>
                <span>*</span><strong>Note:</strong> If you encounter issues adding an item to the cart multiple times, please consider clearing the cache or use the incognito mode.
            </div>
        </div>
    </div>
    <?php 
        $query = "SELECT tc.item_id, tc.prod_qnty, tc.branch_id, tb.branch_name, tp.* FROM `tbl_cart` tc 
        INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id 
        INNER JOIN tbl_branch tb ON tb.branch_id = tc.branch_id
        WHERE tc.account_id = ? AND tc.status_id = 1;";
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
                        <table class="styled-table">
                            <thead>
                                <th class='th-1'></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Branch</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </thead>

                            <tbody>
                                <?php 
                                    $total = 0;
                                    $path = "";
                                    $qnty_value = "";
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

                                    if($data["prod_qnty"] == "0.50"){
                                        $qnty_value = "1/2";
                                    }else if($data["prod_qnty"] == "0.25"){
                                        $qnty_value = "1/4";
                                    }else if($data["prod_qnty"] == "1"){
                                        $qnty_value = "1Kg";
                                    }else{
                                        $qnty_value = "2Kg";
                                    }
                                ?>
                                <tr>
                                    <td class="img-con"><img src="../assets/<?php echo $path; ?>/<?php echo $data["prod_img"]; ?>" alt=""></td>
                                    <td><?php echo $data["prod_name"]; ?></td>
                                    <td>₱<?php echo $data["prod_price"]; ?></td>
                                    <td><?php echo $data["branch_name"]; ?></td>
                                    <td>
                                        <div class="qnty-td">
                                            <!-- <div class="minus-btn" data-branch-id="<?php echo $data["branch_id"]; ?>">-</div> -->
                                        <!-- <input type="text" class="qnty-input" min="1" value="1"> -->
                                            <div class="qnty-js"><?php echo $qnty_value; ?></div>
                                            <!-- <div class="add-btn" data-branch-id="<?php echo $data["branch_id"]; ?>">+</div> -->
                                        </div>
                                    </td>
                                    <td class="total-price-js">₱<span class="subtotal-js"><?php echo $subtotal; ?></span></td>
                                    <td class="delete-js" id="<?php echo $data["item_id"]; ?>"><i class="fa-solid fa-x"></i></td> 
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="right-con">
                    <div class="total-con">
                        <h1>Cart totals</h1>
                        <div class="price-div">
                            <div class="text">
                                <div>Subtotal:</div>
                                <span class="text-price">₱<?php echo $total; ?></span>
                            </div>
                            <div class="text">
                                <div>Total:</div>
                                <span class="text-total">₱<?php echo $total; ?></span>
                            </div>
                            <div class="text">
                                <div>Discount: </div>
                                <span class="discount">₱0.00</span>
                            </div>
                            <button type="button" class="btn btn-primary" 
                                data-toggle="modal" data-target="#exampleModal"
                                data-whatever="@mdo">
                                Pick up now
                            </button>
                        </div>
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

    <!--MODAL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receipt Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Your Receipt:</label>
                        <input type="file" class="form-control-file" id="receiptFile">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Reference Number</label>
                        <input type="text" class="form-control" id="refNumber">
                    </div>
                    <div class="img-con" style="height: 350px; padding-bottom: 20px;">
                        <label class="col-form-label">Send Your Payment Here:</label>
                        <img src="../assets/imgs/qr-code.jpeg" alt="" style="object-fit: contain;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary proceed-btn">Proceed</button>
            </div>
            </div>
        </div>
    </div>

    <?php include "./footer.php" ?>
    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
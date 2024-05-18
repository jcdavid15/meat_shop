<?php require_once("../backend/config/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/products.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Products</title>
</head>
<body>
<?php include "./navbar.php" ?>
    <main>
        <div class="center">
            <div class="con">
                <div class="header-con">
                    <h1>Deli Meat Products</h1>
                    <p>> All Deli Meat Products</p>
                    <div class="flex-prod">
                        <a href="./products.php"><div>Beef</div></a>
                        <a href="./porkprod.php"><div>Pork</div></a>
                        <a href="./chickenprod.php"><div>Chicken</div></a>
                        <a href="./lambprod.php"><div>Lamb</div></a>
                        <a href="./deliprod.php"><div style="background: rgb(23, 68, 113);
                        color: white;">Deli Meats</div></a>
                    </div>
                </div>
                <div class="container">
                    <?php
                        $query = "SELECT pr.prod_id, pr.prod_name, pr.prod_stocks, pr.prod_price, pr.prod_type,
                        pr.prod_img, pt.prod_type_name FROM tbl_products pr
                        INNER JOIN tbl_product_type pt ON pr.prod_type = pt.prod_type_id;";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($data = $result->fetch_assoc())
                        {
                            if($data['prod_type'] == 5 && ($data['prod_stocks'] >= 1)){
                    ?>
                    <div class="con-item" id="<?php echo $data['prod_id']; ?>">
                        <div class="img-con">
                            <img src="../assets/deli_meats/<?php echo $data['prod_img']; ?>" alt="">
                        </div>
                        <div class="flex-con-det">
                            <div class="con-details">
                                <div class="name"><?php echo $data["prod_name"]; ?></div>
                                <div class="price">₱<?php echo $data['prod_price']; ?>.00 PHP</div>
                                <div class="check"><i class="fa-solid fa-check"></i></div>
                            </div>
                            <div class="input-div">
                                <span>Quantity:</span>
                                <input type="number" class="qnty" min="1" value="1">
                            </div>
                        </div>
                        <div class="flex-con-det">
                            <div class="con-details">
                                <div class="name">Pick up Branch</div>
                                <select name="branch" class="branch">
                                    <option value="1">Bagbag</option>
                                    <option value="2">Sauyo</option>
                                </select>
                            </div>
                        </div>
                        <div class="div-button">
                            <button>ORDER NOW</button>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "./footer.php" ?>
    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/addtocart.js"></script>
</body>
</html>
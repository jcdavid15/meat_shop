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
                    <h1>Products</h1>
                    <p>> All Available Products</p>
                    <div class="flex-prod">
                        <?php 
                            $queryType = "SELECT * FROM tbl_product_type";
                            $stmtType = $conn->prepare($queryType);
                            $stmtType->execute();
                            $resultType = $stmtType->get_result();
                            $first = true;
                            while($data = $resultType->fetch_assoc()){
                                $style = $first ? 'style="background: rgb(23, 68, 113); color: white;"' : '';
                                $first = false;
                                $prodTypeId = $data["prod_type_id"];
                        ?>
                            <div class="prod-type" data-type-id="<?php echo $prodTypeId; ?>" <?php echo $style; ?>>
                                <?php echo $data["prod_type_name"]; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="container" id="product-container">
                    <?php
                        $defaultType = 1;
                        $query = "SELECT pr.prod_id, pr.prod_stocks, pr.prod_name, pr.prod_price, pr.prod_type, pr.prod_img, pt.prod_type_name 
                                  FROM tbl_products pr
                                  INNER JOIN tbl_product_type pt ON pr.prod_type = pt.prod_type_id
                                  WHERE pr.prod_type = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $defaultType);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($data = $result->fetch_assoc()) {
                            $formattedTypeName = strtolower(str_replace(' ', '_', $data["prod_type_name"]));
                            if ($data['prod_stocks'] >= 1) {
                    ?>
                    <div class="con-item" id="<?php echo $data['prod_id']; ?>">
                        <div class="img-con">
                            <img src="../assets/<?php echo $formattedTypeName; ?>/<?php echo $data['prod_img']; ?>" alt="">
                        </div>
                        <div class="flex-con-det">
                            <div class="con-details">
                                <div class="name"><?php echo $data["prod_name"]; ?></div>
                                <div class="price">₱<?php echo number_format($data['prod_price'], 2); ?> PHP</div>
                                <div class="check"><i class="fa-solid fa-check"></i></div>
                            </div>
                            <div class="qnty-div">
                                <div class="name">Order Quantity</div>
                                <select name="qnty" class="qnty">
                                    <option value="1/2">1/2</option>
                                    <option value="1/4">1/4</option>
                                    <option value="1Kg">1Kg</option>
                                    <option value="2Kg">2Kg</option>
                                    <option value="3Kg">3Kg</option>
                                    <option value="4Kg">4Kg</option>
                                    <option value="5Kg">5Kg</option>
                                    <option value="6Kg">6Kg</option>
                                    <option value="7Kg">7Kg</option>
                                    <option value="8Kg">8Kg</option>
                                    <option value="9Kg">9Kg</option>
                                    <option value="10Kg">10Kg</option>
                                </select>
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
                            <div class="input-div">
                                <div>Stocks: 
                                    <span style="font-weight: 500;">
                                        <?php echo $data["prod_stocks"] ?>
                                    </span>
                                </div>
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
    <script>
        $(document).ready(function(){
            $('.prod-type').click(function(){
                var typeId = $(this).data('type-id');//type-id = 2
                $('.prod-type').removeAttr('style');
                $(this).css({'background': 'rgb(23, 68, 113)', 'color': 'white'});
                loadProducts(typeId);
            });

            function loadProducts(typeId) {
                $.ajax({
                    url: 'fetch_products.php',
                    type: 'GET',
                    data: { type: typeId },
                    success: function(response) {
                        $('#product-container').html(response);
                    }
                });
            }
        });//jquery = framework, ajax = library
    </script>
    <script src="../scripts/navbar.js"></script>
    <script src="../jquery/addtocart.js"></script>
</body>
</html>

<?php 
require_once("../backend/config/config.php");

if (isset($_GET['type'])) {
    $type = intval($_GET['type']);
    $query = "SELECT pr.prod_id, pr.prod_stocks, pr.prod_name, pr.prod_price, pr.prod_type, pr.prod_img, pt.prod_type_name 
              FROM tbl_products pr
              INNER JOIN tbl_product_type pt ON pr.prod_type = pt.prod_type_id
              WHERE pr.prod_type = ? AND pr.prod_stocks >= 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $type);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($data = $result->fetch_assoc()) {
        $formattedTypeName = strtolower(str_replace(' ', '_', $data["prod_type_name"]));
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
                    <input type="number" min="0.5" placeholder="Min of 1/2" class="qnty">
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
<?php
    }
}
?>

<script src="../jquery/addtocart.js"></script>

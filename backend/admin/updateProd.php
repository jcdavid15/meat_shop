<?php 
require_once("../config/config.php");

if(isset($_POST["prod_id"]) && isset($_POST["prod_name"]) 
    && isset($_POST["prod_price"]) && isset($_POST["prod_stocks"])){

    $prod_id = $_POST["prod_id"];
    $prod_name = $_POST["prod_name"];
    $prod_price = $_POST["prod_price"];
    $prod_stocks = $_POST["prod_stocks"];

    $query = "UPDATE tbl_products SET prod_name=?, prod_price=?, prod_stocks=? WHERE prod_id=?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("ssii", $prod_name, $prod_price, $prod_stocks, $prod_id);

    if($stmt->execute()){
        echo "success";
    } else {
        echo "error";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

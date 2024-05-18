<?php 
session_start();
require_once("../reports/reports.php");

if(isset($_POST["prod_id"]) && isset($_POST["prod_name"]) 
    && isset($_POST["prod_price"]) && isset($_POST["prod_stocks"])){

    $prod_id = $_POST["prod_id"];
    $prod_name = $_POST["prod_name"];
    $prod_price = $_POST["prod_price"];
    $prod_stocks = $_POST["prod_stocks"];
    $account_id = $_SESSION["admin_id"];

    $query = "UPDATE tbl_products SET prod_name=?, prod_price=?, prod_stocks=? WHERE prod_id=?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("ssii", $prod_name, $prod_price, $prod_stocks, $prod_id);
    if($stmt->execute()){
        echo "success";
    } else {
        echo "error";
    }

    $query2 = "SELECT ac_username FROM tbl_account WHERE account_id = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("i", $account_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $username = $data["ac_username"];
        $act = "Updated Product";
        $type = "Admin";
        report($conn, $account_id, $username, $act, $type);
    }


    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

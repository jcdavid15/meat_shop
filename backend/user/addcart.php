<?php
require_once("../config/config.php");
session_start();

if (isset($_POST["prodId"]) && isset($_POST["qnty"]) && isset($_POST["branch"])) {
    $account_id = $_SESSION["user_id"];
    $prod_id = $_POST["prodId"];
    $prod_qnty = $_POST["qnty"];
    $branch_id = $_POST["branch"];

    // Fetch current stock level
    $queryStock = "SELECT prod_stocks FROM tbl_products WHERE prod_id = ?";
    $stmtStock = $conn->prepare($queryStock);
    $stmtStock->bind_param("i", $prod_id);
    $stmtStock->execute();
    $resultStock = $stmtStock->get_result();

    if ($resultStock->num_rows > 0) {
        $stockData = $resultStock->fetch_assoc();
        $currentStock = intval($stockData["prod_stocks"]);

        if ($prod_qnty <= $currentStock) {
            // Check if the product is already in the cart
            $query = "SELECT * FROM tbl_cart WHERE prod_id = ? AND account_id = ? AND status_id = 1 AND branch_id = ? AND prod_qnty = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iiid", $prod_id, $account_id, $branch_id, $prod_qnty);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "exceeds";
            } else {
                $query2 = "INSERT INTO tbl_cart (prod_id, prod_qnty, branch_id, account_id) VALUES (?, ?, ?, ?)";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param("idii", $prod_id, $prod_qnty, $branch_id, $account_id);
                $stmt2->execute();
                echo "success";
            }
        } else {
            echo "low";
        }
    } else {
        echo "Error: Product not found.";
    }
}
?>

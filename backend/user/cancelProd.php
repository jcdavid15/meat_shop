<?php
    session_start();
    require_once("../config/config.php");

    if(isset($_GET["prodId"])){
        $user_id = $_SESSION["user_id"];
        $status_id = 5;
        $item_id = $_GET["prodId"];

        $query = "UPDATE tbl_cart SET status_id = ? WHERE item_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $status_id, $item_id);
        $stmt->execute();

        $query2 = "SELECT prod_id, prod_qnty FROM tbl_cart WHERE item_id = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $item_id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $data = $result->fetch_assoc();
        $prod_id = $data["prod_id"];

        $query3 = "UPDATE tbl_products SET prod_stocks = prod_stocks + ? WHERE prod_id = ?";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("ii", $data["prod_qnty"], $prod_id);
        $stmt3->execute();
        echo "deleted";
    }
?>
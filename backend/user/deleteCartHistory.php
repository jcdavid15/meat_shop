<?php
    session_start();
    require_once("../config/config.php");

    if(isset($_GET["prodId"]) && isset($_GET["branchId"])){
        $user_id = $_SESSION["user_id"];
        $prod_id = $_GET["prodId"];
        $branch_id = $_GET["branchId"];

        $query = "DELETE FROM tbl_cart WHERE item_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $prod_id);
        $stmt->execute();
        echo "deleted";
    }
?>
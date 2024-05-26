<?php
    session_start();
    require_once("../config/config.php");

    if(isset($_GET["itemId"])){
        $user_id = $_SESSION["user_id"];
        $item_id  = $_GET["itemId"];
        // $prod_id = $_GET["prodId"];
        // $branch_id = $_GET["branchId"];

        $query = "DELETE FROM tbl_cart WHERE item_id = ? AND account_id = ? AND status_id = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $item_id, $user_id);
        $stmt->execute();
        echo "deleted";
    }
?>
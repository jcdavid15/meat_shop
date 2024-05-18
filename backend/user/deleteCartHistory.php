<?php
    session_start();
    require_once("../config/config.php");

    if(isset($_GET["prodId"]) && isset($_GET["branchId"])){
        $user_id = $_SESSION["user_id"];
        $prod_id = $_GET["prodId"];
        $branch_id = $_GET["branchId"];

        $query = "DELETE FROM tbl_cart WHERE prod_id = ? AND account_id = ? AND branch_id = ? AND (status_id = 3 OR status_id = 4)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $prod_id, $user_id, $branch_id);
        $stmt->execute();
        echo "deleted";
    }
?>
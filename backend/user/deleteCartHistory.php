<?php
    session_start();
    require_once("../config/config.php");

    if(isset($_GET["prodId"])){
        $user_id = $_SESSION["user_id"];
        $prod_id = $_GET["prodId"];

        $query = "DELETE FROM tbl_cart WHERE prod_id = ? AND account_id = ? AND (status_id = 3 OR status_id = 4)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $prod_id, $user_id);
        $stmt->execute();
        echo "deleted";
    }
?>
<?php 
    require_once("../config/config.php");
    session_start();

    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
        $date = date('Y-m-d');

        $query = "UPDATE tbl_cart SET status_id = 3, order_date = ? WHERE account_id = ? AND status_id = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $date, $user_id);
        
        if($stmt->execute()){
            echo "success";
        }else{
            echo "error";
        }

    }

?>
<?php 
    require_once("../config/config.php");
    session_start();

    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];

        $query = "UPDATE tbl_cart SET status_id = 3 WHERE account_id = ? AND status_id = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        
        if($stmt->execute()){
            echo "success";
        }else{
            echo "error";
        }

    }

?>
<?php  
    require_once("../config/config.php");

    function transaction($conn, $cashier_id, $user_name, $role_id, $current_date, $activity, $branch_id){

        $query3 = "INSERT INTO tbl_transactions (user_id, user_name, user_type, user_activity, activity_date, branch_id)
        VALUES(?, ?, ?, ?, ?, ?)";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("issssi", $cashier_id, $user_name, $role_id, $activity, $current_date, $branch_id);
        $stmt3->execute();
    }
?>
<?php 
    session_start();
    require_once("../reports/trans.php");

    if(isset($_POST["account_id"]) && isset($_POST["status_id"])){
        $account_id = $_POST["account_id"];
        $cashier_id =  $_SESSION["cashier_id"];
        $status_id = $_POST["status_id"];
        $order_date = date('Y-m-d');
        $prod_name = '';
        $current_status = $status_id == 4 || $status_id == 5 ? 3 : 4;
        

        $query = "UPDATE tbl_cart SET status_id = ?, order_date = ? WHERE account_id = ? AND status_id = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isii", $status_id, $order_date, $account_id, $current_status);
        $stmt->execute();

        $query2 = "SELECT ac.ac_username, ac.role_id, ac.branch_id, tr.role_name FROM tbl_account ac 
        INNER JOIN tbl_role tr ON ac.role_id = tr.role_id Where ac.account_id = ?;";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $cashier_id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $user_name = $data["ac_username"];
            $role_id = $data["role_id"];
            $current_date = date('Y-m-d');
            $branch_id = $data["branch_id"];
            $activity = '';

            if($status_id == 4){
                $activity = "Accept item ";
            }else if($status_id == 2){
                $activity = "Claimed items";
            }else if($status_id == 5){
                $activity = "Reject item ";
            }
            
            if($status_id == 2 || $status_id == 5){
                transaction($conn, $cashier_id, $user_name, $role_id, $current_date, $activity, $branch_id);
            }
        }
        echo "success";
    }

?>
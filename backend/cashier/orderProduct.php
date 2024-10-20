<?php 
    session_start();
    require_once("../reports/trans.php");

    if(isset($_POST["branch_id"]) && isset($_POST["qnty"]) && isset($_POST["prod_id"])){
        $cashier_id = $_SESSION["cashier_id"];
        $branch_id = $_POST["branch_id"];
        $prod_id = $_POST["prod_id"];
        $prod_qnty = $_POST["qnty"];
        $status_id = 2;

        $order_date = date('Y-m-d');
        
        $query = "INSERT INTO tbl_cart (prod_id, prod_qnty, branch_id, account_id, status_id, order_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiiiis", $prod_id, $prod_qnty, $branch_id, $cashier_id, $status_id, $order_date);
        $stmt->execute();

        $stock_query = "SELECT prod_stocks FROM tbl_products WHERE prod_id = ?";
        $stock_stmt = $conn->prepare($stock_query);
        $stock_stmt->bind_param("i", $prod_id);
        $stock_stmt->execute();
        $stock_result = $stock_stmt->get_result();
        $stock_data = $stock_result->fetch_assoc();
        $current_stock = $stock_data["prod_stocks"];
        
        $new_stock = $current_stock - $prod_qnty;
        $update_query = "UPDATE tbl_products SET prod_stocks = ? WHERE prod_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ii", $new_stock, $prod_id);
        $update_stmt->execute();

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

            $activity = "Ordered item";
            transaction($conn, $cashier_id, $user_name, $role_id, $current_date, $activity, $branch_id, $item_id);
           
        }
        echo "success";
        exit();
    }


?>
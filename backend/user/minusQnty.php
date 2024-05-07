<?php 
    require_once("../config/config.php");
    session_start();
    if(isset($_GET["prodId"])){
        $account_id = $_SESSION["user_id"];
        $prod_id = $_GET["prodId"];

        $query = "SELECT * FROM tbl_cart WHERE prod_id = ? AND account_id = ? AND status_id = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $prod_id, $account_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $currentQnty = intval($data["prod_qnty"]);

            if($currentQnty >= 1){
                $updatedQnty = $currentQnty - 1;
                $query2 = "UPDATE tbl_cart SET prod_qnty = ? WHERE prod_id = ? AND account_id = ? AND status_id = 1";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param("iii", $updatedQnty, $prod_id, $account_id);
                $stmt2->execute();

                echo $updatedQnty;
            }
            
        }
    }
?>
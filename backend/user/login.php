<?php 
    session_start();
    require_once("../config/config.php");

    if(isset($_POST["email"]) && isset($_POST["password"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = "SELECT ta.account_id, ta.ac_password, ta.branch_id, ta.ac_username, ta.ac_email, ta.account_status_id, ta.role_id, 
        CONCAT(td.first_name, ' ', td.middle_name, ' ', td.last_name) AS full_name, 
        td.contact, td.gender, td.address 
        FROM tbl_account ta 
        INNER JOIN tbl_account_details td ON 
        ta.account_id = td.account_id WHERE ta.ac_email = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $hashedPassword = $data["ac_password"];
            


            if(password_verify($password, $hashedPassword))
            {
                $status = $data["account_status_id"];
                if($status == 2){
                    echo "deactivated";
                    exit();
                }
                $query2 = "INSERT INTO tbl_audit_log(log_user_id, log_username, log_user_type) VALUES(?, ?, ?)";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param("isi", $data["account_id"], $data["ac_username"], $data["role_id"]);
                $stmt2->execute();

                $role_id = $data["role_id"];
                $sessionData = array(
                    "account_id" => $data["account_id"],
                    "role_id" => $data["role_id"],
                    "username" =>  $data["ac_username"],
                    "email" => $data["ac_email"],
                    "full_name" => $data["full_name"],
                    "contact" => $data["contact"],
                    "gender" => $data["gender"],
                    "address" => $data["address"],
                    "branch_id" => $data["branch_id"]
                );
                if($role_id == 1){
                    $_SESSION["user_id"] = $data["account_id"];
                }else if($role_id == 2){
                    $_SESSION["admin_id"] = $data["account_id"];
                }else if($role_id == 3){
                    $_SESSION["cashier_id"] = $data["account_id"];
                }
                echo json_encode($sessionData);
            }else{
                echo "Invalid Password";
            }

        }else{
            echo "Invalid Password";
        }
    }


?>
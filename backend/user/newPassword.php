<?php 

    require_once("../config/config.php");

    if(isset($_POST["email"]) && isset($_POST["password"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM tbl_account WHERE ac_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();   
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $query = "UPDATE tbl_account SET ac_password = ? WHERE ac_email =  ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $hashedPassword, $email);
            $stmt->execute();
            echo "success";
        }else{
            echo "invalid";
        }
    }

?>
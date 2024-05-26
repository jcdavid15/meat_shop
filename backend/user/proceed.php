<?php 
require_once("../config/config.php");
session_start();

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
    $date = date('Y-m-d');

    // Check if a file was uploaded
    if(isset($_FILES['receipt']) && $_FILES['receipt']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../receipts/'; // Ensure this directory exists and is writable
        $originalFileName = basename($_FILES['receipt']['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFileName;

        // Move the uploaded file to the target directory
        if(move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadFile)) {
            // File successfully uploaded, now insert into tbl_receipt
            $ref_number = $_POST["refNumber"];
            $receiptQuery = "INSERT INTO tbl_receipt (account_id, receipt_img, receipt_number, uploaded_date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($receiptQuery);
            $stmt->bind_param("isss", $user_id, $uniqueFileName, $ref_number, $date);

            if($stmt->execute()){
                // If the insert into tbl_receipt is successful, update tbl_cart
                $cartQuery = "UPDATE tbl_cart SET status_id = 3, order_date = ? WHERE account_id = ? AND status_id = 1";
                $stmt = $conn->prepare($cartQuery);
                $stmt->bind_param("si", $date, $user_id);

                if($stmt->execute()){
                    echo "success";
                } else {
                    echo "error_updating_cart";
                }
            } else {
                echo "error_inserting_receipt";
            }
        } else {
            // File upload failed
            echo "file_upload_error";
        }
    } else {
        // No file was uploaded or there was an error
        echo "no_file_or_upload_error";
    }
} else {
    echo "user_not_logged_in";
}
?>

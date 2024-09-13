<?php 
require_once("../config/config.php");
session_start();

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $date = date('Y-m-d');

    // Check if a file was uploaded
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../receipts/';
        $originalFileName = basename($_FILES['receipt']['name']);
        $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "invalid_file_type";
            exit();
        }

        // Generate a unique file name
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFileName;

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadFile)) {
            $ref_number = $_POST["refNumber"];
            $depositAmount = $_POST["depositAmount"];

            // Fetch all distinct branch_ids from tbl_cart for the user
            $getBranches = "SELECT DISTINCT branch_id FROM tbl_cart WHERE account_id = ? AND status_id = 1";
            $stmt = $conn->prepare($getBranches);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Loop through each branch and insert a receipt for each one
            while ($data = $result->fetch_assoc()) {
                $branch_id = $data["branch_id"];

                // Insert receipt for each branch
                $receiptQuery = "INSERT INTO tbl_receipt (account_id, receipt_img, receipt_number, deposit_amount, uploaded_date, branch_id) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($receiptQuery);
                $stmt->bind_param("issisi", $user_id, $uniqueFileName, $ref_number, $depositAmount, $date, $branch_id);

                if ($stmt->execute()) {
                    // Update tbl_cart for the current branch
                    $cartQuery = "UPDATE tbl_cart SET status_id = 3, order_date = ? WHERE account_id = ? AND status_id = 1 AND branch_id = ?";
                    $stmt = $conn->prepare($cartQuery);
                    $stmt->bind_param("sii", $date, $user_id, $branch_id);

                    if (!$stmt->execute()) {
                        echo "error_updating_cart_for_branch_" . $branch_id;
                        exit();
                    }
                } else {
                    echo "error_inserting_receipt_for_branch_" . $branch_id;
                    exit();
                }
            }

            echo "success";
        } else {
            echo "file_upload_error";
        }
    } else {
        echo "no_file_or_upload_error";
    }
} else {
    echo "user_not_logged_in";
}
?>
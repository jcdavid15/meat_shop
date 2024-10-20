<?php
session_start();
require_once("../reports/reports.php");

if (isset($_FILES["qr_img"])) {

    $targetDir = "../../assets/imgs/";
    $prod_img = $_FILES['qr_img'];

    // Check for upload errors
    if ($prod_img['error'] !== UPLOAD_ERR_OK) {
        echo "error_upload";
        exit();
    }

    // Ensure the upload is a valid image
    $targetFile = $targetDir . basename($prod_img['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate the image format
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "error_image_format";
        exit();
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($prod_img["tmp_name"], $targetFile)) {
        echo "error_uploading_image";
        exit();
    }

    // Prepare and execute the database update
    $query = "UPDATE tbl_qr_img SET qr_img = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $prod_img['name']);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error_inserting_data";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "error_invalid_request";
}
?>

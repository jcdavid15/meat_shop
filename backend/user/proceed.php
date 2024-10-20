<?php 
require_once("../config/config.php");
session_start();

if (!isset($_SESSION["user_id"])) {
    echo "user_not_logged_in";
    exit();
}

$user_id = $_SESSION["user_id"];
$date = date('Y-m-d');
$return = "success";

try {
    // Start a transaction
    $conn->begin_transaction();

    // Fetch cart items for the user
    $query3 = "SELECT prod_id, item_id, prod_qnty FROM tbl_cart WHERE account_id = ? AND status_id = 1";
    $stmt3 = $conn->prepare($query3);
    $stmt3->bind_param("i", $user_id);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    // Store cart items in an array for later processing
    $cartItems = [];
    while ($data = $result3->fetch_assoc()) {
        $cartItems[] = $data;
    }

    // Check product stock and update the cart
    foreach ($cartItems as $data) {
        $prod_id = $data["prod_id"];
        $prod_qnty = $data["prod_qnty"];
        $item_id = intval($data["item_id"]);

        // Check product stock
        $queryCheck = "SELECT prod_stocks, prod_name FROM tbl_products WHERE prod_id = ?";
        $stmtCheck = $conn->prepare($queryCheck);
        $stmtCheck->bind_param("i", $prod_id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $row = $resultCheck->fetch_assoc();
            $current_stock = $row["prod_stocks"];
            $prod_name = $row["prod_name"];

            if ($prod_qnty > $current_stock) {
                $delete = "DELETE FROM `tbl_cart` WHERE item_id = ?";
                $stmtDelete = $conn->prepare($delete);
                $stmtDelete->bind_param("i", $item_id);
                $stmtDelete->execute();
                $conn->commit();
                $stmtDelete->close();
                $stmtCheck->close();
                $return = "exceeds";
            }
        } else {
            throw new Exception("Product not found.");
        }
    }

    // If any item was removed due to exceeding stock, handle it
    if ($return == "exceeds") {
        echo $return;
        exit();
    }

    // Update stock for valid items
    foreach ($cartItems as $data) {
        $prod_id = $data["prod_id"];
        $prod_qnty = $data["prod_qnty"];

        $query2 = "UPDATE tbl_products SET prod_stocks = prod_stocks - ? WHERE prod_id = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("ii", $prod_qnty, $prod_id);
        if (!$stmt2->execute()) {
            throw new Exception("Error updating stock for product ID: " . $prod_id);
        }
    }

    // Check for receipt upload
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../receipts/';
        $originalFileName = basename($_FILES['receipt']['name']);
        $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new Exception("Invalid file type.");
        }

        // Generate a unique file name
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFileName;

        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadFile)) {
            throw new Exception("File upload error.");
        }

        $ref_number = $_POST["refNumber"];
        $depositAmount = $_POST["depositAmount"];

        // Fetch all distinct branch_ids from tbl_cart for the user
        $getBranches = "SELECT DISTINCT branch_id FROM tbl_cart WHERE account_id = ? AND status_id = 1";
        $stmtBranches = $conn->prepare($getBranches);
        $stmtBranches->bind_param("i", $user_id);
        $stmtBranches->execute();
        $resultBranches = $stmtBranches->get_result();

        // Loop through each branch and insert a receipt for each one
        while ($branchData = $resultBranches->fetch_assoc()) {
            $branch_id = $branchData["branch_id"];

            // Insert receipt for each branch
            $receiptQuery = "INSERT INTO tbl_receipt (account_id, receipt_img, receipt_number, deposit_amount, uploaded_date, branch_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtReceipt = $conn->prepare($receiptQuery);
            $stmtReceipt->bind_param("issisi", $user_id, $uniqueFileName, $ref_number, $depositAmount, $date, $branch_id);

            if (!$stmtReceipt->execute()) {
                throw new Exception("Error inserting receipt for branch ID: " . $branch_id);
            }

            // Update tbl_cart for the current branch
            $cartQuery = "UPDATE tbl_cart SET status_id = 3, order_date = ? WHERE account_id = ? AND status_id = 1 AND branch_id = ?";
            $stmtCart = $conn->prepare($cartQuery);
            $stmtCart->bind_param("sii", $date, $user_id, $branch_id);

            if (!$stmtCart->execute()) {
                throw new Exception("Error updating cart for branch ID: " . $branch_id);
            }
        }

        echo $return;
    } else {
        throw new Exception("No file uploaded or there was an upload error.");
    }

    // Commit transaction
    $conn->commit();
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo "error: " . $e->getMessage();
}
?>

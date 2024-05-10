<?php
// First, establish a database connection
require_once("../config/config.php");

if (
    isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])
) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare the SQL statement to insert data into the database
    $query = "INSERT INTO tbl_reports (rp_name, rp_email, rp_message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

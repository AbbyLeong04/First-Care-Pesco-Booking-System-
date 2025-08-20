<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

session_start();

// Check if user is logged in
if (!isset($_SESSION['customer_ID'])) {
    header("Location: http://localhost/projectFYP/dashboardMy/User/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['payment_file'])) {
    $payment_ID = $_POST['payment_ID'];
    $uploadDir = '/projectFYP/dashboardMy/User/payment-record/'; // Relative path for database
    $uploadFile = $uploadDir . basename($_FILES['payment_file']['name']);
    
    // Move the uploaded file to the server
    if (move_uploaded_file($_FILES['payment_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $uploadFile)) {
        // Update the database with the relative path
        $query = "UPDATE payment SET payment_Upload = :uploadFile WHERE payment_ID = :payment_ID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':uploadFile', $uploadFile); // save relative path
        $stmt->bindParam(':payment_ID', $payment_ID);
        $stmt->execute();
    
        echo "<script>alert('File uploaded'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/payments.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to upload file'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/payments.php';</script>";
        exit();
    }
}
?>


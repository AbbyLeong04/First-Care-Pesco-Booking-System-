<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
session_start();

if (!isset($_GET['payment_ID'])) {
    echo "Invalid request.";
    exit();
}

$payment_ID = $_GET['payment_ID'];

// Retrieve payment and booking details for the specified payment ID
$query = "
    SELECT 
        p.payment_ID, p.payment_Upload, p.payment_Price, p.payment_Status, p.payment_date,
        b.booking_ID, b.booking_Service, b.booking_Date, b.booking_Time, b.booking_Location, b.booking_sqft,
        c.customer_Name
    FROM payment p
    JOIN booking b ON p.booking_ID = b.booking_ID
    JOIN customer c ON b.customer_ID = c.customer_ID
    WHERE p.payment_ID = :payment_ID AND p.payment_Status = 'completed'
";

$stmt = $conn->prepare($query);
$stmt->bindParam(':payment_ID', $payment_ID);
$stmt->execute();
$receiptData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$receiptData) {
    echo "No receipt data found.";
    exit();
}

// Generate receipt details in a structured table format
echo "
<div class='receipt-header'>
    <img src='/projectFYP/dashboardMy/User/assets/logo/logo.png' alt='Company Logo'>
    <h1>First Care Management Service</h1>
    <p>Official Receipt</p>
</div>
<table class='receipt-table'>
    <tr><th>Username</th><td>" . htmlspecialchars($receiptData['customer_Name']) . "</td></tr>
    <tr><th>Payment ID</th><td>" . htmlspecialchars($receiptData['payment_ID']) . "</td></tr>
    <tr><th>Payment Amount</th><td>RM " . htmlspecialchars($receiptData['payment_Price']) . "</td></tr>
    <tr><th>Booking ID</th><td>" . htmlspecialchars($receiptData['booking_ID']) . "</td></tr>
    <tr><th>Booking Date</th><td>" . htmlspecialchars($receiptData['booking_Date']) . "</td></tr>
    <tr><th>Booking Time</th><td>" . htmlspecialchars($receiptData['booking_Time']) . "</td></tr>
    <tr><th>Service Name</th><td>" . htmlspecialchars($receiptData['booking_Service']) . "</td></tr>
    <tr><th>Square Footage</th><td>" . htmlspecialchars($receiptData['booking_sqft']) . " sqft</td></tr>
    <tr><th>Location</th><td>" . htmlspecialchars($receiptData['booking_Location']) . "</td></tr>
</table>";

// Add payment file link if available
if (!empty($receiptData['payment_Upload']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $receiptData['payment_Upload'])) {
    echo "<p><a href='" . $receiptData['payment_Upload'] . "' target='_blank'>View Payment File</a></p>";
}
?>

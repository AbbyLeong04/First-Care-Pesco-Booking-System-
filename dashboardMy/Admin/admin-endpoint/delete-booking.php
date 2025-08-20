<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_GET['booking'])) {
    $booking = $_GET['booking'];

    try {
        $query = "DELETE FROM `booking` WHERE `booking_ID` = :booking_ID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':booking_ID', $booking, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /projectFYP/dashboardMy/Admin/bookings.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>


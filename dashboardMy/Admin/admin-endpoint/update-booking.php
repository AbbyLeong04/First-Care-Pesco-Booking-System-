<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_POST['booking_ID'])) {
    $updateBooking_ID = $_POST['booking_ID'];

    // 查询当前的 booking 数据
    $stmt = $conn->prepare("SELECT * FROM `booking` WHERE `booking_ID` = :booking_ID");
    $stmt->bindParam(':booking_ID', $updateBooking_ID, PDO::PARAM_INT);
    $stmt->execute();
    $currentBooking = $stmt->fetch(PDO::FETCH_ASSOC);

    // 使用 POST 数据，如果为空则保留当前数据
    $updateBooking_Service = !empty($_POST['booking_Service']) ? $_POST['booking_Service'] : $currentBooking['booking_Service'];
    $updateBooking_Date = !empty($_POST['booking_Date']) ? $_POST['booking_Date'] : $currentBooking['booking_Date'];
    $updateBooking_Time = !empty($_POST['booking_Time']) ? $_POST['booking_Time'] : $currentBooking['booking_Time'];
    $updateBooking_State = !empty($_POST['booking_State']) ? $_POST['booking_State'] : $currentBooking['booking_State'];
    $updateBooking_Location = !empty($_POST['booking_Location']) ? $_POST['booking_Location'] : $currentBooking['booking_Location'];
    $updateBooking_Contact = !empty($_POST['booking_Contact']) ? $_POST['booking_Contact'] : $currentBooking['booking_Contact'];
    $updateBooking_sqft = !empty($_POST['booking_sqft']) ? $_POST['booking_sqft'] : $currentBooking['booking_sqft'];
    $updateBooking_Email = !empty($_POST['booking_Email']) ? $_POST['booking_Email'] : $currentBooking['booking_Email'];
    $updateCustomer_ID = !empty($_POST['customer_ID']) ? $_POST['customer_ID'] : $currentBooking['customer_ID'];
    $updateBooking_Status = !empty($_POST['booking_Status']) ? $_POST['booking_Status'] : $currentBooking['booking_Status'];

    try {
        $stmt = $conn->prepare("UPDATE `booking` SET 
            `booking_Service` = :booking_Service,
            `booking_Date` = :booking_Date,
            `booking_Time` = :booking_Time,
            `booking_State` = :booking_State,
            `booking_Location` = :booking_Location,
            `booking_Contact` = :booking_Contact,
            `booking_sqft` = :booking_sqft,
            `booking_Email` = :booking_Email,
            `booking_Status` = :booking_Status
            WHERE `booking_ID` = :booking_ID");

        $stmt->bindParam(':booking_ID', $updateBooking_ID, PDO::PARAM_INT);
        $stmt->bindParam(':booking_Service', $updateBooking_Service);
        $stmt->bindParam(':booking_Date', $updateBooking_Date);
        $stmt->bindParam(':booking_Time', $updateBooking_Time);
        $stmt->bindParam(':booking_State', $updateBooking_State);
        $stmt->bindParam(':booking_Location', $updateBooking_Location);
        $stmt->bindParam(':booking_Contact', $updateBooking_Contact);
        $stmt->bindParam(':booking_sqft', $updateBooking_sqft);
        $stmt->bindParam(':booking_Email', $updateBooking_Email);
        $stmt->bindParam(':booking_Status', $updateBooking_Status);
        $stmt->execute();

        echo "success";
        header("Location: /projectFYP/dashboardMy/Admin/bookings.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>

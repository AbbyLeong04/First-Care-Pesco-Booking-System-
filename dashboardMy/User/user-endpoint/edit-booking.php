<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_POST['booking_ID'])) {
    $updateBooking_ID = $_POST['booking_ID'];

    // Retrieve current booking data
    $stmt = $conn->prepare("SELECT * FROM `booking` WHERE `booking_ID` = :booking_ID");
    $stmt->bindParam(':booking_ID', $updateBooking_ID, PDO::PARAM_INT);
    $stmt->execute();
    $currentBooking = $stmt->fetch(PDO::FETCH_ASSOC);

    // Use POST data, or keep the current data if empty
    $updateBooking_Service = !empty($_POST['booking_Service']) ? $_POST['booking_Service'] : $currentBooking['booking_Service'];
    $updateBooking_Date = !empty($_POST['booking_Date']) ? $_POST['booking_Date'] : $currentBooking['booking_Date'];
    $updateBooking_Time = !empty($_POST['booking_Time']) ? $_POST['booking_Time'] : $currentBooking['booking_Time'];
    $updateBooking_State = !empty($_POST['booking_State']) ? $_POST['booking_State'] : $currentBooking['booking_State'];
    $updateBooking_Location = !empty($_POST['booking_Location']) ? $_POST['booking_Location'] : $currentBooking['booking_Location'];
    $updateBooking_Contact = !empty($_POST['booking_Contact']) ? $_POST['booking_Contact'] : $currentBooking['booking_Contact'];
    $updateBooking_sqft = !empty($_POST['booking_sqft']) ? $_POST['booking_sqft'] : $currentBooking['booking_sqft'];
    $updateBooking_Email = !empty($_POST['booking_Email']) ? $_POST['booking_Email'] : $currentBooking['booking_Email'];
    $updateBooking_Status = !empty($_POST['booking_Status']) ? $_POST['booking_Status'] : $currentBooking['booking_Status'];

    try {

        // 获取今天的日期
        $currentDate = date('Y-m-d');

        // 检查选择的日期是否为过去日期
        if ($updateBooking_Date < $currentDate) {
           echo "<script>alert('You cannot book or edit to a past date.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
         exit();
        }
        // Check if the selected date is a Sunday
        $dayOfWeek = date('w', strtotime($updateBooking_Date));
        if ($dayOfWeek == 0) { // 0 represents Sunday
            echo "<script>alert('Selected date is a holiday (Sunday), booking is unavailable.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
            exit();
        }

        // Check if the service is unavailable on the specified date, time, and state
        $stmt = $conn->prepare("
            SELECT * 
            FROM service 
            WHERE (service_Name = :service_Name OR service_Name = 'all')
            AND (service_Date = :service_Date OR service_Date = 'all')
            AND (service_Time = :service_Time OR service_Time = 'all')
            AND (service_State = :service_State OR service_State = 'all')
            AND service_Status = 'unavailable'
        ");
        $stmt->execute([
            'service_Name' => $updateBooking_Service,
            'service_Date' => $updateBooking_Date,
            'service_Time' => $updateBooking_Time,
            'service_State' => $updateBooking_State
        ]);

        // Check for unavailable record
        $unavailableService = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($unavailableService) {
            echo "<script>alert('Selected service is not available at the specified time and date.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
            exit();
        }

         // 检查编辑后的日期和时间是否超出限制
       $stmt = $conn->prepare("SELECT COUNT(*) FROM booking WHERE booking_Date = :booking_Date AND booking_Time = :booking_Time AND booking_ID != :booking_ID");
       $stmt->execute([
        'booking_Date' => $updateBooking_Date,
        'booking_Time' => $updateBooking_Time,
        'booking_ID' => $updateBooking_ID
        ]);
       $existingBookings = $stmt->fetchColumn();

       if ($existingBookings >= 2) {
        echo "<script>alert('The selected date and time slot already have two bookings. Please select a different time slot.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
        exit();
       }
       else{
        // Update booking data
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

        echo "<script>alert('Success'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
        exit();
    }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

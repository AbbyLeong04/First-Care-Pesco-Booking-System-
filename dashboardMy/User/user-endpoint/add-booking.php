<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); 

session_start();

// 检查是否已登录
if (!isset($_SESSION['customer_ID'])) {
    header("Location: http://localhost/projectFYP/dashboardMy/User/index.php");
    exit();
}

// 从表单中获取数据
$customer_ID = $_SESSION['customer_ID'];
$booking_Service = $_POST['booking_Service'];
$booking_Date = $_POST['booking_Date'];
$booking_Time = $_POST['booking_Time'];
$booking_State = $_POST['booking_State'];
$booking_Location = $_POST['booking_Location'];
$booking_Contact = $_POST['booking_Contact'];
$booking_Email = $_POST['booking_Email'];
$booking_sqft = $_POST['booking_sqft'];


try {
    // 获取今天的日期
$currentDate = date('Y-m-d');

// 检查选择的日期是否为过去日期
if ($booking_Date < $currentDate) {
    echo "<script>alert('You cannot book or edit to a past date.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
    exit();
}

// 检查选定日期是否为星期日
$dayOfWeek = date('w', strtotime($booking_Date));
if ($dayOfWeek == 0) { // 0 表示星期日
    echo "<script>alert('Selected date is a holiday (Sunday), booking is unavailable.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
    exit();
}


// 检查服务是否在指定日期、时间和状态下不可用
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
    'service_Name' => $booking_Service,
    'service_Date' => $booking_Date,
    'service_Time' => $booking_Time,
    'service_State' => $booking_State
]);

// 不可用记录检查
$unavailableService = $stmt->fetch(PDO::FETCH_ASSOC);

if ($unavailableService) {
    echo "<script>alert('Selected service is not available at the specified time and date.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
    exit();
}

    // 检查重复预约数量
    $stmt = $conn->prepare("SELECT COUNT(*) FROM booking WHERE booking_Date = :booking_Date AND booking_Time = :booking_Time");
    $stmt->execute([
        'booking_Date' => $booking_Date,
        'booking_Time' => $booking_Time
    ]);
    $existingBookings = $stmt->fetchColumn();

    if ($existingBookings >= 2) {
        echo "<script>alert('The selected date and time slot already have two bookings. Please select a different time slot.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
        exit();
    }

    if ($existingBookings <= 0) {
        // 开始事务
        $conn->beginTransaction();

        // 插入新的预约记录
        $insertStmt = $conn->prepare("INSERT INTO booking (customer_ID, booking_Service, booking_Date, booking_Time, booking_State, booking_Location, booking_Contact, booking_Email, booking_sqft) VALUES (:customer_ID, :booking_Service, :booking_Date, :booking_Time, :booking_State, :booking_Location, :booking_Contact, :booking_Email, :booking_sqft)");

        $insertStmt->bindParam(':customer_ID', $customer_ID, PDO::PARAM_INT);
        $insertStmt->bindParam(':booking_Service', $booking_Service, PDO::PARAM_STR);
        $insertStmt->bindParam(':booking_Date', $booking_Date, PDO::PARAM_STR);
        $insertStmt->bindParam(':booking_Time', $booking_Time, PDO::PARAM_STR);
        $insertStmt->bindParam(':booking_State', $booking_State, PDO::PARAM_STR);
        $insertStmt->bindParam(':booking_Location', $booking_Location, PDO::PARAM_STR);
        $insertStmt->bindParam(':booking_Contact', $booking_Contact, PDO::PARAM_STR);
        $insertStmt->bindParam(':booking_Email', $booking_Email, PDO::PARAM_STR);
        $insertStmt->bindParam(':booking_sqft', $booking_sqft, PDO::PARAM_STR);

        $insertStmt->execute();

        // 提交事务
        $conn->commit();
        echo "<script>alert('Booking added successfully'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
    } else {
        echo "<script>alert('This booking already exists.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/bookings.php';</script>";
    }
} catch (PDOException $e) {
    // 出错时回滚事务
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}
?>

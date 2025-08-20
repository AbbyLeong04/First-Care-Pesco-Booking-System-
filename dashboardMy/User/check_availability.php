<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

// 获取参数
$date = $_GET['date'] ?? '';
$time = $_GET['time'] ?? '';
$state = $_GET['state'] ?? '';
$serviceName = $_GET['serviceName'] ?? '';
$sqft = $_GET['sqft'] ?? '';
$optionType = $_GET['optionType'] ?? '';

// 初始化返回数据
$response = [
    'unavailableTimes' => [],
    'unavailableStates' => [],
    'unavailableServices' => [],
    'unavailableSqft' => [],
    'unavailableDate' => false
];

// 检查星期日不可用
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];
    $dayOfWeek = date('w', strtotime($selectedDate));

    if ($dayOfWeek == 0) {
        echo json_encode(['status' => 'unavailable']);
        exit();
    }
}

// 检查日期是否为不可用
if ($date) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM service WHERE (service_Date = :date OR service_Date = 'all') AND service_Status = 'unavailable'");
    $stmt->execute(['date' => $date]);
    if ($stmt->fetchColumn() > 0) {
        $response['unavailableDate'] = true;
    }
}

// 根据不同选项类型获取不可用项
try {
    if ($optionType === 'time') {
        $stmt = $conn->prepare("SELECT service_Time FROM service WHERE (service_Date = :date OR service_Date = 'all') AND (service_State = :state OR service_State = 'all') AND service_Status = 'unavailable'");
        $stmt->execute(['date' => $date, 'state' => $state]);
        $response['unavailableTimes'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } elseif ($optionType === 'state') {
        $stmt = $conn->prepare("SELECT service_State FROM service WHERE (service_Date = :date OR service_Date = 'all') AND (service_Time = :time OR service_Time = 'all') AND service_Status = 'unavailable'");
        $stmt->execute(['date' => $date, 'time' => $time]);
        $response['unavailableStates'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } elseif ($optionType === 'service') {
        $stmt = $conn->prepare("SELECT service_Name FROM service WHERE (service_Date = :date OR service_Date = 'all') AND (service_Time = :time OR service_Time = 'all') AND (service_State = :state OR service_State = 'all') AND service_Status = 'unavailable'");
        $stmt->execute(['date' => $date, 'time' => $time, 'state' => $state]);
        $response['unavailableServices'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } elseif ($optionType === 'sqft') {
        $stmt = $conn->prepare("SELECT service_sqft FROM service WHERE (service_Date = :date OR service_Date = 'all') AND (service_Time = :time OR service_Time = 'all') AND (service_State = :state OR service_State = 'all') AND (service_Name = :serviceName OR service_Name = 'all') AND service_Status = 'unavailable'");
        $stmt->execute(['date' => $date, 'time' => $time, 'state' => $state, 'serviceName' => $serviceName]);
        $response['unavailableSqft'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

header('Content-Type: application/json');
echo json_encode($response);
?>

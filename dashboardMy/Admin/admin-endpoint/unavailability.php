<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); 

// 从表单获取数据
$service_Name = $_POST['service_Name'] ?? null;
$service_sqft = $_POST['service_sqft'] ?? null;
$service_Date = $_POST['service_Date'];
$service_Time = $_POST['service_Time'] ?? null;
$service_State = $_POST['service_State'] ?? null;
$service_Status = $_POST['service_Status'] ?? 'available';

// 检查是否选中 "select all" 选项，并在此情况下设置字段为 "all"
$service_Name = ($service_Name === 'selectAllService') ? 'all' : $service_Name;
$service_sqft = ($service_sqft === 'selectAllSqft') ? 'all' : $service_sqft;
$service_Time = ($service_Time === 'selectAllTime') ? 'all' : $service_Time;
$service_State = ($service_State === 'selectAllState') ? 'all' : $service_State;

try {
    // 检查是否已有相同的不可用记录
    $stmt = $conn->prepare("SELECT * FROM service WHERE service_Name = :service_Name AND service_Date = :service_Date AND service_Time = :service_Time AND service_State = :service_State AND service_sqft = :service_sqft");
    $stmt->execute([
        'service_Name' => $service_Name,
        'service_Date' => $service_Date,
        'service_Time' => $service_Time,
        'service_State' => $service_State,
        'service_sqft' => $service_sqft
    ]);
    $serviceExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($serviceExist)) {
        // 插入新的不可用服务记录
        $insertStmt = $conn->prepare("INSERT INTO service (service_Name, service_sqft, service_Date, service_Time, service_State, service_Status) VALUES (:service_Name, :service_sqft, :service_Date, :service_Time, :service_State, :service_Status)");
        
        $insertStmt->bindParam(':service_Name', $service_Name);
        $insertStmt->bindParam(':service_sqft', $service_sqft);
        $insertStmt->bindParam(':service_Date', $service_Date);
        $insertStmt->bindParam(':service_Time', $service_Time);
        $insertStmt->bindParam(':service_State', $service_State);
        $insertStmt->bindParam(':service_Status', $service_Status);

        $insertStmt->execute();
        echo "<script>alert('Availability added successfully'); window.location.href = 'http://localhost/projectFYP/dashboardMy/Admin/index.php';</script>";
    } else {
        echo "<script>alert('Service availability already exists'); window.location.href = 'http://localhost/projectFYP/dashboardMy/Admin/index.php';</script>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

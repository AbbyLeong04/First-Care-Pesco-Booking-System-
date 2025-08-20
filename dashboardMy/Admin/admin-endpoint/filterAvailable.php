<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

// 获取请求中的过滤数据
$data = json_decode(file_get_contents("php://input"), true);
$date = $data['date'];
$time = $data['time'];
$state = $data['state'];

// 动态生成查询
$query = "SELECT * FROM `service` WHERE 1=1";
if (!empty($date)) {
   $query .= " AND service_Date = :date";
}
if ($time !== 'all' && !empty($time)) {
   $query .= " AND service_Time = :time";
}
if ($state !== 'all' && !empty($state)) {
   $query .= " AND service_State = :state";
}

$stmt = $conn->prepare($query);

if (!empty($date)) {
   $stmt->bindParam(':date', $date);
}
if ($time !== 'all' && !empty($time)) {
   $stmt->bindParam(':time', $time);
}
if ($state !== 'all' && !empty($state)) {
   $stmt->bindParam(':state', $state);
}

$stmt->execute();
$filteredServices = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 返回 JSON 格式的过滤结果
echo json_encode($filteredServices);
?>

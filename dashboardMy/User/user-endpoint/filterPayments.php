<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

// 获取请求中的过滤数据
$ID = json_decode(file_get_contents("php://input"), true);
if (!$ID || !isset($ID['ID'])) {
    echo json_encode([]); // 返回空数组
    exit;
}
$booking_ID = $ID['ID'];

// 动态生成查询
$query = "SELECT * FROM `payment` WHERE 1=1";
if (!empty($booking_ID)) {
    $query .= " AND booking_ID = :ID";
}

$stmt = $conn->prepare($query);

if (!empty($booking_ID)) {
    $stmt->bindParam(':ID', $booking_ID, PDO::PARAM_STR);
}

$stmt->execute();
$filteredPayments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 返回 JSON 格式的过滤结果
echo json_encode($filteredPayments);
?>

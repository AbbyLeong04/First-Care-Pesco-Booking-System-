<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

// 获取请求中的过滤数据
$ID = json_decode(file_get_contents("php://input"), true);
$customer_ID = $ID['ID']; // 解析 JSON 数据

// 动态生成查询
$query = "SELECT * FROM `customer` WHERE 1=1";
if (!empty($customer_ID)) {
    $query .= " AND customer_ID = :ID";
}

$stmt = $conn->prepare($query);

if (!empty($customer_ID)) {
    $stmt->bindParam(':ID', $customer_ID);
}

$stmt->execute();
$filteredCustomers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 返回 JSON 格式的过滤结果
echo json_encode($filteredCustomers);
?>

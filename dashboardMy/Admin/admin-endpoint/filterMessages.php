<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

// 获取请求中的过滤数据
$email = json_decode(file_get_contents("php://input"), true);
if (!$email || !isset($email['email'])) {
    echo json_encode([]); // 返回空数组
    exit;
}
$contact_Email = $email['email'];

// 动态生成查询
$query = "SELECT * FROM `contact` WHERE 1=1";
if (!empty($contact_Email)) {
    $query .= " AND contact_Email = :email";
}

$stmt = $conn->prepare($query);

if (!empty($contact_Email)) {
    $stmt->bindParam(':email', $contact_Email, PDO::PARAM_STR);
}

$stmt->execute();
$filteredMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 返回 JSON 格式的过滤结果
header('Content-Type: application/json');
echo json_encode($filteredMessages);
?>

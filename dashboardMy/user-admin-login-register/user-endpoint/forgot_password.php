<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
session_start();
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$customer_Email = $data['customer_Email'];
$school = $data['school'];
$gender = $data['gender'];
$secret = $data['secret'];

// 确保输入数据存在
if (empty($customer_Email) || empty($school) || empty($gender) || empty($secret)) {
    echo json_encode(["success" => false, "error" => "All fields are required."]);
    exit();
}

// 查询数据库是否存在匹配的记录
$stmt = $conn->prepare("SELECT `customer_ID`, `customer_Name` FROM customer WHERE customer_Email = ? AND school = ? AND gender = ? AND secret = ?");
$stmt->execute([$customer_Email, $school, $gender, $secret]);
$customer = $stmt->fetch();

if ($customer) {
    // 成功匹配 - 设置 SESSION
    $_SESSION['customer_ID'] = $customer['customer_ID'];
    $_SESSION['customer_Name'] = $customer['customer_Name']; // 可选
    
    echo json_encode(["success" => true]);
} else {
    // 匹配失败
    echo json_encode(["success" => false, "error" => "No matching records found."]);
}
?>

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$customer_ID = $_SESSION['customer_ID'];
$customer_Password = $data['customer_Password']; // 用户输入的密码

// 查询数据库中的明文密码
$stmt = $conn->prepare("SELECT customer_Password FROM customer WHERE customer_ID = ?");
$stmt->execute([$customer_ID]);
$dbPassword = $stmt->fetchColumn();

if ($dbPassword && $customer_Password === $dbPassword) {
    // 验证成功
    echo json_encode(["success" => true]);
} else {
    // 验证失败
    echo json_encode(["success" => false, "error" => "Incorrect password"]);
}
?>

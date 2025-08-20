<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['customer_ID'])) {
    // 如果用户没有登录，重定向到登录页面
    header("window.location.href = 'http://localhost/projectFYP/dashboardMy/user-login-register/user-log.php';");
    exit();
}

// 从会话中获取用户ID
$customer_ID = $_SESSION['customer_ID'];

// 使用用户ID查询数据，确保只显示当前用户的资料
$stmt = $conn->prepare("SELECT * FROM `customer` WHERE `customer_ID` = :customer_ID");
$stmt->execute(['customer_ID' => $customer_ID]);
$result = $stmt->fetchAll();
?>
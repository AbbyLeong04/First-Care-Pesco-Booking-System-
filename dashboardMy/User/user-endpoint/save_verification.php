<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$customer_ID = $_SESSION['customer_ID'];

$stmt = $conn->prepare("UPDATE customer SET school = ?, gender = ?, secret = ? WHERE customer_ID = ?");
$result = $stmt->execute([$data['school'], $data['gender'], $data['secret'], $customer_ID]);

echo json_encode(["success" => $result]);
?>

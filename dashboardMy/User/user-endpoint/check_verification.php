<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
session_start();
$customer_ID = $_SESSION['customer_ID'];

$stmt = $conn->prepare("SELECT school, gender, secret FROM customer WHERE customer_ID = ?");
$stmt->execute([$customer_ID]);
$data = $stmt->fetch();

if ($data) {
    echo json_encode([
        "exists" => true,
        "school" => $data['school'],
        "gender" => $data['gender'],
        "secret" => $data['secret']
    ]);
} else {
    echo json_encode(["exists" => false]);
}
?>

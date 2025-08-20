<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_POST['payment_ID'])) {
    $updatePayment_ID = $_POST['payment_ID'];

    // 查询当前的数据
    $stmt = $conn->prepare("SELECT * FROM `payment` WHERE `payment_ID` = :payment_ID");
    $stmt->bindParam(':payment_ID', $updatePayment_ID, PDO::PARAM_INT);
    $stmt->execute();
    $currentPayment = $stmt->fetch(PDO::FETCH_ASSOC);

    // 使用 POST 数据，如果为空则保留当前数据
    $updatePayment_Price = !empty($_POST['payment_Price']) ? $_POST['payment_Price'] : $currentPayment['payment_Price'];
    $updatePayment_Status= !empty($_POST['payment_Status']) ? $_POST['payment_Status'] : $currentPayment['payment_Status'];

    try {
        $stmt = $conn->prepare("UPDATE `payment` SET 
            `payment_Price` = :payment_Price,
            `payment_Status` = :payment_Status
            WHERE `payment_ID` = :payment_ID");

        $stmt->bindParam(':payment_ID', $updatePayment_ID, PDO::PARAM_INT);
        $stmt->bindParam(':payment_Price', $updatePayment_Price);
        $stmt->bindParam(':payment_Status', $updatePayment_Status);
        $stmt->execute();

        echo "success";
        header("Location: /projectFYP/dashboardMy/Admin/payments.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_POST['customer_ID'])) {
    $updateCustomer_ID = $_POST['customer_ID'];

    // 查询当前的数据
    $stmt = $conn->prepare("SELECT * FROM `customer` WHERE `customer_ID` = :customer_ID");
    $stmt->bindParam(':customer_ID', $updateCustomer_ID, PDO::PARAM_INT);
    $stmt->execute();
    $currentCustomer = $stmt->fetch(PDO::FETCH_ASSOC);

    // 使用 POST 数据，如果为空则保留当前数据
    $updateCustomer_Name = !empty($_POST['customer_Name']) ? $_POST['customer_Name'] : $currentCustomer['customer_Name'];
    $updateCustomer_Password= !empty($_POST['customer_Password']) ? $_POST['customer_Password'] : $currentCustomer['customer_Password'];
    $updateCustomer_FirstName = !empty($_POST['customer_FirstName']) ? $_POST['customer_FirstName'] : $currentCustomer['customer_FirstName'];
    $updateCustomer_LastName = !empty($_POST['customer_LastName']) ? $_POST['customer_LastName'] : $currentCustomer['customer_LastName'];
    $updateCustomer_Contact = !empty($_POST['customer_Contact']) ? $_POST['customer_Contact'] : $currentCustomer['customer_Contact'];
    $updateCustomer_Email = !empty($_POST['customer_Email']) ? $_POST['customer_Email'] : $currentCustomer['customer_Email'];

    try {
        $stmt = $conn->prepare("UPDATE `customer` SET 
            `customer_Name` = :customer_Name,
            `customer_Password` = :customer_Password,
            `customer_FirstName` = :customer_FirstName,
            `customer_LastName` = :customer_LastName,
            `customer_Contact` = :customer_Contact,
            `customer_Email` = :customer_Email
            WHERE `customer_ID` = :customer_ID");

        $stmt->bindParam(':customer_ID', $updateCustomer_ID, PDO::PARAM_INT);
        $stmt->bindParam(':customer_Name', $updateCustomer_Name);
        $stmt->bindParam(':customer_Password', $updateCustomer_Password);
        $stmt->bindParam(':customer_FirstName', $updateCustomer_FirstName);
        $stmt->bindParam(':customer_LastName', $updateCustomer_LastName);
        $stmt->bindParam(':customer_Contact', $updateCustomer_Contact);
        $stmt->bindParam(':customer_Email', $updateCustomer_Email);
        $stmt->execute();

        echo "success";
        header("Location: /projectFYP/dashboardMy/Admin/customers.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>

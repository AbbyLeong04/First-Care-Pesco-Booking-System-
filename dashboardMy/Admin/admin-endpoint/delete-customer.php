<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_GET['customer'])) {
    $customer = $_GET['customer'];

    try {
        $query = "DELETE FROM `customer` WHERE `customer_ID` = :customer_ID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':customer_ID', $customer, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /projectFYP/dashboardMy/Admin/customers.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>


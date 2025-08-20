<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_GET['service'])) {
    $service = $_GET['service'];

    try {
        $query = "DELETE FROM `service` WHERE `service_ID` = :service_ID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':service_ID', $service, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /projectFYP/dashboardMy/Admin/index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>



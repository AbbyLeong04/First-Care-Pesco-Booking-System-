<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_POST['service_ID'])) {
    $updateService_ID = $_POST['service_ID'];

    // 查询当前的 booking 数据
    $stmt = $conn->prepare("SELECT * FROM `service` WHERE `service_ID` = :service_ID");
    $stmt->bindParam(':service_ID', $updateService_ID, PDO::PARAM_INT);
    $stmt->execute();
    $currentService = $stmt->fetch(PDO::FETCH_ASSOC);

    // 使用 POST 数据，如果为空则保留当前数据
    $updateService_Name = !empty($_POST['service_Name']) ? $_POST['service_Name'] : $currentService['service_Name'];
    $updateService_sqft = !empty($_POST['service_sqft']) ? $_POST['service_sqft'] : $currentService['service_sqft'];
    $updateService_Date = !empty($_POST['service_Date']) ? $_POST['service_Date'] : $currentService['service_Date'];
    $updateService_Time = !empty($_POST['service_Time']) ? $_POST['service_Time'] : $currentService['service_Time'];
    $updateService_State = !empty($_POST['service_State']) ? $_POST['service_State'] : $currentService['service_State'];
    $updateService_Status = !empty($_POST['service_Status']) ? $_POST['service_Status'] : $currentService['service_Status'];

    try {
        $stmt = $conn->prepare("UPDATE `service` SET 
            `service_Name` = :service_Name,
            `service_sqft` = :service_sqft,
            `service_Date` = :service_Date,
            `service_Time` = :service_Time,
            `service_State` = :service_State,
            `service_Status` = :service_Status
            WHERE `service_ID` = :service_ID");

        $stmt->bindParam(':service_ID', $updateService_ID, PDO::PARAM_INT);
        $stmt->bindParam(':service_Name', $updateService_Name);
        $stmt->bindParam(':service_sqft', $updateService_sqft);
        $stmt->bindParam(':service_Date', $updateService_Date);
        $stmt->bindParam(':service_Time', $updateService_Time);
        $stmt->bindParam(':service_State', $updateService_State);
        $stmt->bindParam(':service_Status', $updateService_Status);
        $stmt->execute();

        echo "success";
        header("Location: /projectFYP/dashboardMy/Admin/index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');


$customer_FirstName = $_POST['customer_FirstName'];
$customer_LastName = $_POST['customer_LastName'];
$customer_Contact = $_POST['customer_Contact'];
$customer_Email = $_POST['customer_Email'];
$customer_Name = $_POST['customer_Name'];
$customer_Password = $_POST['customer_Password'];




try {
    $stmt = $conn->prepare("SELECT `customer_FirstName`, `customer_LastName` FROM `customer` WHERE `customer_FirstName` = :customer_FirstName AND `customer_LastName` = :customer_LastName");
    $stmt->execute([
        'customer_FirstName' => $customer_FirstName,
        'customer_LastName' => $customer_LastName
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        $conn->beginTransaction();

        $insertStmt = $conn->prepare("INSERT INTO `customer` (`customer_ID`, `customer_FirstName`, `customer_LastName`, `customer_Contact`, `customer_Email`, `customer_Name`, `customer_Password`) VALUES (NULL, :customer_FirstName, :customer_LastName, :customer_Contact, :customer_Email, :customer_Name, :customer_Password)");
        $insertStmt->bindParam(':customer_FirstName', $customer_FirstName, PDO::PARAM_STR);
        $insertStmt->bindParam(':customer_LastName', $customer_LastName, PDO::PARAM_STR);
        $insertStmt->bindParam(':customer_Contact', $customer_Contact, PDO::PARAM_INT);
        $insertStmt->bindParam(':customer_Email', $customer_Email, PDO::PARAM_STR);
        $insertStmt->bindParam(':customer_Name', $customer_Name, PDO::PARAM_STR);
        $insertStmt->bindParam(':customer_Password', $customer_Password, PDO::PARAM_STR);
        $insertStmt->execute();

        $conn->commit();
        echo "<script>alert('Registered Successfully'); window.location.href = 'https://localhost/projectFYP/dashboardMy/user-admin-login-register/user-log.php';</script>";
    } else {
        echo "<script>alert('User Already Exist'); window.location.href = 'https://localhost/projectFYP/dashboardMy/user-admin-login-register/user-log.php';</script>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

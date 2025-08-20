<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

$contact_Name = $_POST['contact_Name'];
$contact_Email = $_POST['contact_Email'];
$contact_Message = $_POST['contact_Message'];

try {
    $stmt = $conn->prepare("SELECT `contact_Name`, `contact_Email`, `contact_Message` FROM `contact` WHERE  `contact_Name` = :contact_Name AND `contact_Email` = :contact_Email AND `contact_Message` = :contact_Message");
    $stmt->execute([
        'contact_Name' => $contact_Name,
        'contact_Email' => $contact_Email,
        'contact_Message' => $contact_Message
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        $conn->beginTransaction();

        $insertStmt = $conn->prepare("INSERT INTO `contact` (`contact_ID`, `contact_Name`, `contact_Email`, `contact_Message`) VALUES (NULL, :contact_Name, :contact_Email, :contact_Message)");
        $insertStmt->bindParam(':contact_Name', $contact_Name, PDO::PARAM_STR);
        $insertStmt->bindParam(':contact_Email', $contact_Email, PDO::PARAM_STR);
        $insertStmt->bindParam(':contact_Message', $contact_Message, PDO::PARAM_STR);
        $insertStmt->execute();

        $conn->commit();
        echo "<script>alert('Message Send Successfully'); window.location.href = 'http://localhost/projectFYP/main/Contact.php';</script>";
    } else {
        echo "<script>alert('Message Already Exist'); window.location.href = 'http://localhost/projectFYP/main/Contact.php';</script>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

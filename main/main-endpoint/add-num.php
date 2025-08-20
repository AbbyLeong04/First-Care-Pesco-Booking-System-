<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

$user_Number = $_POST['user_Number'];

try {
    $stmt = $conn->prepare("SELECT `user_Number` FROM `user_call` WHERE  `user_Number` = :user_Number");
    $stmt->execute([
        'user_Number' => $user_Number
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        $conn->beginTransaction();

        $insertStmt = $conn->prepare("INSERT INTO `user_call` (`user_ID`, `user_Number`) VALUES (NULL, :user_Number)");
        $insertStmt->bindParam(':user_Number', $user_Number, PDO::PARAM_STR);
        $insertStmt->execute();

        $conn->commit();
        echo "<script>alert('Admin will get in touch with you in between this 2 days, thank you!'); window.location.href = 'http://localhost/projectFYP/main/index.php';</script>";
    } else {
        echo "<script>alert('Failed to send'); window.location.href = 'http://localhost/projectFYP/main/index.php';</script>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

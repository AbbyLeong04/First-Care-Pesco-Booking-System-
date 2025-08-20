<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if (isset($_GET['contact'])) {
    $contact = $_GET['contact'];

    try {
        $query = "DELETE FROM `contact` WHERE `contact_ID` = :contact_ID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':contact_ID', $contact, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /projectFYP/dashboardMy/Admin/messages.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>


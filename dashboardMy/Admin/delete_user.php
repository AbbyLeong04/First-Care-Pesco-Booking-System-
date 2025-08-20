<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $user_ID = $input['user_ID'];

    try {
        $query = "DELETE FROM `user_call` WHERE `user_ID` = :user_ID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_ID', $user_ID, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['success' => true]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }
}
?>

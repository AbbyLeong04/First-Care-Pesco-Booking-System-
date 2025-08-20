<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

// 禁止页面缓存
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_GET['customer'])) {
    $customer = $_GET['customer'];

    try {
        // 开始事务
        $conn->beginTransaction();

        // 删除与用户相关的记录 (假设有订单和支付记录表)
        $deleteBookings = "DELETE FROM `booking` WHERE `customer_ID` = :customer_ID";
        $stmt = $conn->prepare($deleteBookings);
        $stmt->bindParam(':customer_ID', $customer, PDO::PARAM_INT);
        $stmt->execute();

        // 删除用户账号
        $deleteCustomer = "DELETE FROM `customer` WHERE `customer_ID` = :customer_ID";
        $stmt = $conn->prepare($deleteCustomer);
        $stmt->bindParam(':customer_ID', $customer, PDO::PARAM_INT);
        $stmt->execute();

        // 提交事务
        $conn->commit();

        // 跳转到用户登录页面
       
        // 使用 Ajax 调用来在用户确认后执行 PHP 的会话销毁
        echo '<script>
             alert("Account deleted successfully.");
            fetch("./delete_process.php", { method: "POST" })
            .then(() => window.location.href = "http://localhost//projectFYP/main/index.php");
         </script>';
        exit();
    
    } catch (PDOException $e) {
        // 回滚事务
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

?>

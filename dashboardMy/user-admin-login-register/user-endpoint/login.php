<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_Name = $_POST['customer_Name'];
    $customer_Password = $_POST['customer_Password'];

    // 查询数据库，查找用户名对应的 ID 和密码
    $stmt = $conn->prepare("SELECT `customer_ID`, `customer_Password`FROM `customer` WHERE `customer_Name` = :customer_Name");
    $stmt->bindParam(':customer_Name', $customer_Name);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $customer_ID = $row['customer_ID'];
        $stored_password = $row['customer_Password'];

        if ($customer_Password === $stored_password) {
            // 登录成功，将用户 ID 保存到 SESSION 中
            $_SESSION['customer_ID'] = $customer_ID;

            echo "
            <script>
                alert('Login Successfully!');
                window.location.href = 'http://localhost/projectFYP/dashboardMy/User/index.php';
            </script>
            "; 
        } else {
            echo "
            <script>
                alert('Login Failed, Incorrect Password!');
                window.location.href = 'http://localhost/projectFYP/dashboardMy/user-admin-login-register/user-log.php';
            </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Login Failed, User Not Found!');
                window.location.href = 'http://localhost/projectFYP/dashboardMy/user-admin-login-register/user-log.php';
            </script>
            ";
    }
}
?>

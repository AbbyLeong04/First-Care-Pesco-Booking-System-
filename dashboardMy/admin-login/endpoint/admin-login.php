<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_Name = $_POST['admin_Name'];
    $admin_Password = $_POST['admin_Password'];

    // 查询数据库，查找用户名对应的 ID 和密码
    $stmt = $conn->prepare("SELECT `admin_ID`, `admin_Password` FROM `admin` WHERE `admin_Name` = :admin_Name");
    $stmt->bindParam(':admin_Name', $admin_Name);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $admin_ID = $row['admin_ID'];
        $stored_password = $row['admin_Password'];

        if ($admin_Password === $stored_password) {
            // 登录成功，将用户 ID 保存到 SESSION 中
            $_SESSION['admin_ID'] = $admin_ID;

            echo "
            <script>
                alert('Login Successfully!');
                window.location.href = 'http://localhost/projectFYP/dashboardMy/Admin/index.php';
            </script>
            "; 
        } else {
            echo "
            <script>
                alert('Login Failed, Incorrect Password!');
                window.location.href = 'http://localhost/projectFYP/dashboardMy/admin-login/admin-log.php';
            </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Login Failed, Account Not Found!');
                window.location.href ='http://localhost/projectFYP/dashboardMy/admin-login/admin-log.php';
            </script>
            ";
    }
}
?>

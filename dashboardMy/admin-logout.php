<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <script>
        function confirmLogout() {
            // 显示确认对话框
            var confirmation = confirm("Are you sure you want to logout?");
            if (confirmation) {
                // 如果用户点击“是”，清除会话并重定向到登录页面
                <?php
                // 使用 Ajax 调用来在用户确认后执行 PHP 的会话销毁
                echo '
                    fetch("logout_process.php", { method: "POST" })
                    .then(() => window.location.href = "http://localhost/projectFYP/main/index.php");
                ';
                ?>
            } else {
                // 如果用户点击“否”，返回之前的页面或跳转到用户主页
                window.location.href = 'http://localhost/projectFYP/dashboardMy/Admin/index.php'; 
            }
        }

        // 当页面加载时调用 confirmLogout 函数
        window.onload = confirmLogout;
    </script>
</head>
<body>
</body>
</html>

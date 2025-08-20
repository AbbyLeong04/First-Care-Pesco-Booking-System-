<?php
// 数据库连接（假设已连接到数据库）
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

// 提示信息
$message = ''; 

// 如果表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单提交的值
    $service_Date = $_POST['service_Date'];
    $service_Time = $_POST['service_Time'];
    $service_State = $_POST['service_State'];
    $service_Name = $_POST['service_Name'];
    $service_Sqft = $_POST['service_sqft'];

    // 检查选定日期是否为星期日
    $dayOfWeek = date('w', strtotime($service_Date));  // 获取星期几
    if ($dayOfWeek == 0) { // 0 表示星期日
        echo "<script>alert('Selected date is a holiday (Sunday), service is unavailable.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/index.php';</script>";
        exit();
           // 获取今天的日期
           $currentDate = date('Y-m-d');

           // 检查选择的日期是否为过去日期
           if ($updateBooking_Date < $currentDate) {
              echo "<script>alert('You cannot book or edit to a past date.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/index.php';</script>";
            exit();
           }
    }


    // 查询数据库查看所选服务是否可用
    $stmt = $conn->prepare("SELECT * FROM service 
                            WHERE (service_Name = :service_Name OR service_Name = 'all')
                            AND (service_Date = :service_Date OR service_Date = 'all')
                            AND (service_Time = :service_Time OR service_Time = 'all')
                            AND (service_State = :service_State OR service_State = 'all')
                            AND (service_sqft = :service_sqft OR service_sqft = 'all')
                            AND service_Status = 'unavailable'");

    // 绑定参数
    $stmt->bindParam(':service_Name', $service_Name);
    $stmt->bindParam(':service_Date', $service_Date);
    $stmt->bindParam(':service_Time', $service_Time);
    $stmt->bindParam(':service_State', $service_State);
    $stmt->bindParam(':service_sqft', $service_Sqft);
    
    // 执行查询
    $stmt->execute();
    
    // 获取查询结果
    $result = $stmt->fetchAll();

    // 如果查询结果为空，说明该服务可以用
    if (empty($result)) {
        $message = 'Service is available.';
        echo "<script>alert('$message'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/index.php';</script>";
        exit();
    } else {
        $message = 'Service is unavailable.';
        echo "<script>alert('$message'); window.location.href = 'http://localhost/projectFYP/dashboardMy/User/index.php';</script>";
        exit();
    }
}
?>

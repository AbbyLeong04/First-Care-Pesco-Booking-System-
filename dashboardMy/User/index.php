<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
session_start();

// 调试阶段：输出 SESSION 数据
if (!isset($_SESSION['customer_ID'])) {
    echo "<script>
        alert('Please login first.');
        window.location.href = 'https://localhost/projectFYP/dashboardMy/user-admin-login-register/user-log.php';
    </script>";
    exit();
}

// 用户已登录 - 获取用户信息
$customer_ID = $_SESSION['customer_ID'];

// 查询数据库获取用户详细信息
$stmt = $conn->prepare("SELECT `customer_Name`, `customer_Email` FROM `customer` WHERE `customer_ID` = :customer_ID");
$stmt->bindParam(':customer_ID', $customer_ID);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch();
    $customer_Name = $user['customer_Name'];
    $customer_Email = $user['customer_Email'];
} else {
    // 用户数据不存在，清除 SESSION 并重定向到登录页面
    session_unset();
    session_destroy();
    echo "<script>
        alert('User not found. Please login again.');
        window.location.href = 'https://localhost/projectFYP/dashboardMy/user-admin-login-register/user-log.php';
    </script>";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/side-bar.css">
    <link rel="stylesheet" href="assets/css/booking-form.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/verify.css">
    <link rel="stylesheet" href="assets/css/chat-Bot.css">
    <script src="assets/js/chat.js"></script>
    <script src="assets/js/verify.js"></script>
</head>

<body>
    <!-- Chatbot Icon -->
<div id="chatbot-icon" onclick="toggleChat()">
    <div id="icon-logo">🤖</div>
    <div id="chatbot-tooltip">Hi There!</div>
</div>

<!-- Chatbot Window -->
<div id="chatbot-window">
    <div id="chatbot-header">
        <span>First Care Chatbot</span>
        <button id="close-btn" onclick="toggleChat()">✖</button>
    </div>
    <div id="chatbot-body">
        <div id="messages"></div>
    </div>
</div>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
            <div class="user-side">
                <span class="user-icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <span class="dashboard-title">User Dashboard</span>
            </div>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>


                <li>
                    <a href="bookings.php">
                        <span class="icon">
                            <ion-icon name="bookmark-outline"></ion-icon>
                        </span>
                        <span class="title">Bookings</span>
                    </a>
                </li>

                <li>
                    <a href="payments.php">
                        <span class="icon">
                            <ion-icon name="wallet-outline"></ion-icon>
                        </span>
                        <span class="title">Payments</span>
                    </a>
                </li>

                <li>
                <a href="#" onclick="openSettingModal()">
                  <span class="icon">
                    <ion-icon name="settings-outline"></ion-icon>
                  </span>
                  <span class="title">Setting</span>
                </a>
                </li>

                <li>
                <a href="#" onclick="openVerifyModal()">
                  <span class="icon">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                  </span>
                  <span class="title">Verification</span>
                </a>
                </li>

                <li>
                    <a href="../logout.php">
                        <span class="icon">
                            <ion-icon name="log-in-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>

            </ul>
            <div class="footer">
              &copy; 2024 First Care Pest Management
            </div>
  </div>
        </div>

        <!-- ========================= Main ==================== -->
<!--main是整体的形状哦，不管任何一方的事-->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                
                <div class="cardHeader">
                    <h2>First Care Pest Management</h2>
                </div>
        
            </div>

            
                <div class="cardBox">
                <div class="card">
                    <div class="iconBx">
                       <ion-icon name="phone-portrait-outline"></ion-icon>
                    </div>
                    <div>
                        <div class="cardTitle">If Booking Status=Confirmed</div>
                        <div class="cardName">Admin will get in touch with u in 2 days</div>
                    </div>
                </div>

                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="bookmarks-outline"></ion-icon>
                    </div>
                    <div>
                        <div class="cardTitle">Check Services Availability</div>
                        <div class="cardName">Before Booking</div>
                    </div>

                </div>

                <div class="card">
                 <div class="iconBx">
                  <ion-icon name="cash-outline"></ion-icon>
                 </div>
                  <div>
                    <div class="cardTitle">Do Your Payment</div>
                    <div class="cardName">To the Bank Account: xxxxxxxxxxxxx</div>
                    <button class="popupButton" onclick="showPopup()">QR-Pay</button>
                 </div>


                </div>

                <div class="card">
                    <div class="iconBx">
                        <ion-icon name="chatbox-outline"></ion-icon>
                    </div>
                    <div>
                        <div class="cardTitle">Contact Us</div>
                        <div class="cardName">firstcarepest@gmail.com</div>
                        <div class="cardName">0126881880</div>
                    </div>

                </div>
            </div>
    

       <!-- Popup Image Container -->
<div id="popupContainer" class="popupContainer" style="display: none;">
    <div class="popupContent">
        <span class="closeButton" onclick="closePopup()">&times;</span>
        <img src="./duitnow.img/duitnow.jpg" alt="Bank Account Details" class="popupImage">
    </div>
</div>

            <div class="all-container">
    <!-- Profile Details -->
              <div class="profile-container">
        <!-- Profile Details Content -->
                 <div class="outside">
                    <div class="text-upper">
                       <div style="display: flex; justify-content: space-between; align-items: center;">
                           <h2>Customer Profile</h2>
                           <a href="#" class="booking-btn" id="openModalBtn">Make a booking</a>
                       </div>
                    </div>

            <div class="profile-cards">
                <?php
                $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_ID = :customer_ID");
                $stmt->bindParam(':customer_ID', $customer_ID);
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach ($result as $row) {
                    $customer_ID = $row['customer_ID'];
                    $customer_Name = $row['customer_Name'];
                    $customer_Password = $row['customer_Password'];
                    $customer_FirstName = $row['customer_FirstName'];
                    $customer_LastName = $row['customer_LastName'];
                    $customer_Contact = $row['customer_Contact'];
                    $customer_Email = $row['customer_Email'];
                ?>
                    <div class="profile-card-input">
                        <p><strong>Customer ID:</strong> <?php echo $customer_ID; ?></p>
                        <p><strong>Username:</strong> <?php echo $customer_Name; ?></p>
                        <p><strong>Password:</strong> <?php echo $customer_Password; ?></p>
                        <p><strong>First Name:</strong> <?php echo $customer_FirstName; ?></p>
                        <p><strong>Last Name:</strong> <?php echo $customer_LastName; ?></p>
                        <p><strong>Mobile:</strong> <?php echo $customer_Contact; ?></p>
                        <p><strong>Email:</strong> <?php echo $customer_Email; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include('editProfile.php'); ?>
    <?php include('form.php'); ?>


    <!-- Service Availability Check -->
    <div class="service-container">
        <div class="outside">
            <div class="text-upper">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2 style="color:white">Services Availability Check</h2>
                </div>
            </div>
            <?php include('form.php'); ?>
            <div class="check-content">
                <form action="./user-endpoint/check-available.php" method="POST" class="check-container">
                <div class="check-group">
                <label for="service_Date">Date</label>
                <input type="date" placeholder="MM/DD/YYYY" id="service_Date" name="service_Date" required data-date-format="mm/dd/yyyy">
            </div>

            <div class="check-group">
                <label for="service_Time">Time</label>
                <select id="service_Time" name="service_Time" required>
                    <option value="9:30am - 10:30am">9:30am - 10:30am</option>
                    <option value="10:30am - 11:30am">10:30am - 11:30am</option>
                    <option value="11:30am - 12:30pm">11:30am - 12:30pm</option>
                    <option value="12:30pm - 1:30pm">12:30pm - 1:30pm</option>
                    <option value="1:30pm - 2:30pm">1:30pm - 2:30pm</option>
                    <option value="2:30pm - 3:30pm">2:30pm - 3:30pm</option>
                    <option value="3:30pm - 4:30pm">3:30pm - 4:30pm</option>
                    <option value="4:30pm - 5:30pm">4:30pm - 5:30pm</option>
                </select>
            </div>

            <div class="check-group">
                <label for="service_State">State</label>
                <select id="service_State" name="service_State" required>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Johor">Johor</option>
                </select>
            </div>

            <div class="check-group">
                <label for="service_Name">Services</label>
                <select id="service_Name" name="service_Name" required>
                    <option value="Ant Treatment">Ant Treatment</option>
                    <option value="Termite Treatment">Termite Treatment</option>
                    <option value="Rodent Treatment">Rodent Treatment</option>
                    <option value="Fly Treatment">Fly Treatment</option>
                    <option value="Cockroach Treatment">Cockroach Treatment</option>
                    <option value="Bed Bugs Treatment">Bed Bugs Treatment</option>
                    <option value="Mosquito Treatment">Mosquito Treatment</option>
                    <option value="Disinfection Service">Disinfection Service</option>
                </select>
            </div>

            <div class="check-group">
                <label for="service_sqft">Place SQFT</label>
                <select id="service_sqft" name="service_sqft" required>
                    <option value="1500sqft Below">1500sqft Below</option>
                    <option value="2000sqft Below">2000sqft Below</option>
                    <option value="2500sqft Below">2500sqft Below</option>
                    <option value="3000sqft Below">3000sqft Below</option>
                    <option value="4000sqft Below">4000sqft Below</option>
                    <option value="5000sqft Below">5000sqft Below</option>
                    <option value="10,000sqft Below">10,000sqft Below</option>
                    <option value="10,000sqft Above">10,000sqft Above</option>
                </select>
            </div>

            <button type="submit" class="check-submit-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>  
<!-- Setting Modal -->
<div id="settingModal" class="setting-modal">
    <div class="setting-modal-content">
        <span class="close-btn" onclick="closeSettingModal()">&times;</span>
        <h3 class="setting-modal-title">Account Setting</h3>
        <div class="setting-modal-buttons">
            <button class="modal-btn edit-btn" onclick="update_customer(<?php echo $customer_ID ?>)">Edit Profile</button>
            <button class="modal-btn delete-btn" onclick="delete_customer(<?php echo $customer_ID ?>)">Delete Account</button>
        </div>
    </div>
</div>

<?php include('editProfile.php'); ?>

<?php include ('verification.php'); ?>



<script>
function openSettingModal() {
    // 显示弹窗
    document.getElementById('settingModal').style.display = 'flex';
}

function closeSettingModal() {
    // 隐藏弹窗
    document.getElementById('settingModal').style.display = 'none';
}
</script>

<script>
        function showPopup() {
    document.getElementById("popupContainer").style.display = "flex";
}

        function closePopup() {
    document.getElementById("popupContainer").style.display = "none";
}

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateField = document.getElementById('service_Date');
    
    // 获取当前日期，并设置为输入框的最小值
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayString = `${yyyy}-${mm}-${dd}`;

    dateField.setAttribute('min', todayString);
});
</script>

</div>             
</div>
    
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
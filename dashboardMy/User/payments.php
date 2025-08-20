<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');

session_start();
if (!isset($_SESSION['customer_ID'])) {
    echo "<script>alert('Please login first.'); window.location.href = 'https://localhost/projectFYP/dashboardMy/user-admin-login-register/user-log.php'; </script>";
    exit();
}

$customer_ID = $_SESSION['customer_ID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/side-br-short.css">
    <link rel="stylesheet" href="assets/css/booking-form.css">
    <link rel="stylesheet" href="assets/css/receipt.css">
    <link rel="stylesheet" href="assets/css/payment-search.css">
    <link rel="stylesheet" href="assets/css/payment-table.css">
    <link rel="stylesheet" href="assets/css/verify.css">
    <link rel="stylesheet" href="assets/css/chat-Bot.css">
    <script src="assets/js/chat.js"></script>
    <script src="assets/js/verify.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                         <!-- ================ search menu ================= -->
<div class="search-modal">
   <div class="search-content">
      <h2 style="margin-bottom:20px; color: white;">Search Payments</h2>
      <form class="search-form">
         <label for="filterID">BookingID:</label>
         <input type="text" id="filterID" name="filterID">
         
         <button type="button" onclick="filterPayments()">search</button>
      </form>
   </div>
</div>

<script>
function filterPayments() {
    const ID = document.getElementById('filterID').value;

    fetch('./user-endpoint/filterPayments.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ ID: ID }) // 确保 JSON 键名一致
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const tableBody = document.querySelector('.table-body');
        tableBody.innerHTML = ''; // 清空之前的记录

        data.forEach(row => {
            tableBody.innerHTML += `

        <tr>
            <td class="table-data">${row.booking_ID}</td>
            <td class="table-data">${row.payment_ID}</td>
            <td class="table-data">
                ${row.payment_Upload ? 
                  `<a class="viewFileLink" href="${row.payment_Upload}" target="_blank">View Uploaded File</a>` : 
                  `<form action="./user-endpoint/upload-payment.php" method="POST" enctype="multipart/form-data" class="file-upload-form">
                       <input type="hidden" name="payment_ID" value="${row.payment_ID}">
                       <label class="file-label">
                           <input type="file" name="payment_file" required>
                           <span class="file-btn">Choose File</span>
                           <span class="file-chosen">No file chosen</span>
                       </label>
                       <button type="submit" class="upload-btn">Upload</button>
                   </form>`}
            </td>
            <td class="table-data">${row.payment_Price}</td>
            <td class="table-data">
                ${row.payment_Status === 'completed' ? 
                  `<button class="viewReceiptBtn" onclick="showReceipt('${row.payment_ID}')">View Receipt</button>` : 
                  '<span>Receipt unavailable yet</span>'}
            </td>
            <td class="table-data">
                <span class="status ${row.payment_Status.toLowerCase()}">${row.payment_Status}</span>
            </td>
        </tr>

            `;
        });
    })
    .catch(error => console.error('Error:', error));
}

</script>

            <!-- ================ Payment Details List ================= -->
            <div class="outside">
                <div class="text-upper">

                <a href="payments.php"><button class="back-btn">Back after Search</button></a>
                <h2>Payments Details</h2>
                <a href="#" class="booking-btn" id="openModalBtn">Make a booking</a>
                
                </div>

                <?php include('form.php'); ?>
                  

                    <div class="table-container">
                      <table class="table">
                        <thead class="header">
                            <tr>
                            <th class="head">Booking ID</th>
                            <th class="head">Payment ID</th>
                            <th class="head">Payment Upload</th>
                            <th class="head">Total Price</th>
                            <th class="head">Receipt</th>
                            <th class="head">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">

<?php
// Fetch payment records only for the logged-in customer
$stmt = $conn->prepare("
    SELECT p.*, b.customer_ID
    FROM payment p
    JOIN booking b ON p.booking_ID = b.booking_ID
    WHERE b.customer_ID = :customer_ID
    ORDER BY b.booking_ID DESC
");
$stmt->bindParam(':customer_ID', $customer_ID); // current user's ID
$stmt->execute();

$result = $stmt->fetchAll();

foreach ($result as $row) {
    $booking_ID = $row['booking_ID'];
    $payment_ID = $row['payment_ID'];
    $payment_Upload = $row['payment_Upload'];
    $payment_Price = $row['payment_Price'];
    $payment_Status = $row['payment_Status'];
?>
<tr>
    <td class="table-data"><?php echo $booking_ID; ?></td>
    <td class="table-data"><?php echo $payment_ID; ?></td>
    
    <td class="table-data">
        <?php if (!empty($payment_Upload) && file_exists($_SERVER['DOCUMENT_ROOT'] . $payment_Upload)) { ?>
            <!-- Display the uploaded file as a viewable/downloadable link if it exists -->
            <a class="viewFileLink" href="<?php echo $payment_Upload; ?>" target="_blank">View Uploaded File</a>
        <?php } else { ?>
            <!-- Show upload form if no file is uploaded -->
<form action="./user-endpoint/upload-payment.php" method="POST" enctype="multipart/form-data" class="file-upload-form">
    <input type="hidden" name="payment_ID" value="<?php echo $payment_ID; ?>">
    <label class="file-label">
        <input type="file" name="payment_file" required>
        <span class="file-btn">Choose File</span>
        <span class="file-chosen">No file chosen</span>
    </label>
    <button type="submit" class="upload-btn">Upload</button>
</form>

        <?php } ?>
    </td>

    <td class="table-data"><?php echo $payment_Price; ?></td>
    
    <td class="table-data">
        <?php if ($payment_Status == 'completed') { ?>
            <button class="viewReceiptBtn" onclick="showReceipt('<?php echo $payment_ID; ?>')">View Receipt</button>
        <?php } else { ?>
            <span>Receipt available when completed</span>
        <?php } ?>
    </td>
    
    <td class="table-data">
    <span class="status <?php echo strtolower($payment_Status); ?>">
        <?php echo ucfirst($payment_Status); ?>
    </span>
    </td>


</tr>
<?php
}
?>
                        </tbody>
                      </table>
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

<!--receipt pop up-->
<!-- 模糊背景 -->
<div class="modalBackground" onclick="closePopup()"></div>
<!-- 弹窗内容 -->
<div id="receiptPopup" class="receipt-modal">
    <span class="receiptclosebtn" onclick="closePopup()">&times;</span>
    <div id="receiptContent" class="receipt-content"></div>
    <button class="print-btn" onclick="printReceipt()">Print</button>
</div>



<script>
    //以下是file upload的代码
document.querySelectorAll('.file-label input[type="file"]').forEach((input) => {
    const fileChosen = input.nextElementSibling.nextElementSibling; // 找到 .file-chosen

    input.addEventListener('change', (event) => {
        if (event.target.files.length > 0) {
            fileChosen.textContent = event.target.files[0].name; // 显示文件名
        } else {
            fileChosen.textContent = "No file chosen"; // 恢复默认提示
        }
    });
});

//receipt pop up
function showReceipt(payment_ID) {
    fetch(`./user-endpoint/get-receipt.php?payment_ID=${payment_ID}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('receiptContent').innerHTML = data;
            document.querySelector('.modalBackground').style.display = 'block';
            document.querySelector('.receipt-modal').style.display = 'block';
        })
        .catch(error => {
            console.error("Error fetching receipt:", error);
            alert("Failed to load receipt details.");
        });
}

function closePopup() {
    document.querySelector('.modalBackground').style.display = 'none';
    document.querySelector('.receipt-modal').style.display = 'none';
}

function printReceipt() {
    const printContents = document.getElementById('receiptContent').innerHTML;
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Receipt</title></head><body>');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
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
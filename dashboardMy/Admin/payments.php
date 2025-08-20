<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); 
session_start();
if (!isset($_SESSION['admin_ID'])) {
    echo "<script>alert('Please login first.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/user-admin-login-register/admin-log.php'; </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/side-bar.css">
    <link rel="stylesheet" href="assets/css/receipt-pop.css">
    <link rel="stylesheet" href="assets/css/pay-record.css">
    <link rel="stylesheet" href="assets/css/search-Bar-short.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <!-- =============== Navigation ================ -->
  <div class="container">
        <div class="navigation">
            <ul>

            <div class="admin-side">
                <span class="admin-icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <span class="dash-title">Admin Dashboard</span>
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
                    <a href="customers.php">
                        <span class="icon">
                            <ion-icon name="person-add-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
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
                    <a href="messages.php">
                        <span class="icon">
                        <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="../admin-logout.php">
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
        <!-- ========================= Main ==================== -->
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

    fetch('./admin-endpoint/filterPayments.php', {
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
                            '<span>User hasn\'t uploaded payment yet</span>'}
                    </td>
                    <td class="table-data">${row.payment_Price}</td>
                    <td class="table-data">
                        ${row.payment_Status === 'completed' ? 
                            `<button class="viewReceiptBtn" onclick="showReceipt('${row.payment_ID}')">View Receipt</button>` : 
                            '<span>Receipt unavailable yet</span>'}
                    </td>
                    <td class="table-data">
                        <span class="status ${row.payment_Status.toLowerCase()}">
                            ${row.payment_Status.charAt(0).toUpperCase() + row.payment_Status.slice(1)}
                        </span>
                    </td>
                    <td class="table-data">
                        <div class="button-container">
                            <button class="payeditBtn" onclick="update_payment(${row.payment_ID})" title="Edit">
                                &#9998; Edit
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
}
</script>


<style>
    /* 针对表格标题的全局样式 */
.table th.head {
    font-size: 14px; /* 调整为合适的大小 */
    font-weight: bold; /* 保持标题加粗 */
    color: #fff; /* 标题文字颜色 */
    background-color: #140568; /* 保持统一背景颜色 */
    padding: 12px; /* 调整内边距，保持标题一致性 */
    text-align: left; /* 左对齐，符合表格数据风格 */
    border: 1px solid #ccc; /* 与表格边框一致 */
}

</style>


            <!-- ================ Payments Details List ================= -->
            <div class="outside">
                <div class="text-upper">
              
                    <h2 style="font-size:26px;">Payments Record</h2>
                    <a href="payments.php"><button class=back-btn style="font-size: 20px;">Back after Search</button></a>
                
                </div>
                  

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
                            <th class="head">Editing</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">

<?php
$stmt = $conn->prepare(
    " SELECT p.*, b.customer_ID
      FROM payment p
      JOIN booking b ON p.booking_ID = b.booking_ID
      ORDER BY b.booking_ID DESC");

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
            <span>User haven't upload payment yet</span>
        <?php } ?>
    </td>

    <td class="table-data"><?php echo $payment_Price; ?></td>
    
    <td class="table-data">
        <?php if ($payment_Status == 'completed') { ?>
            <button class="viewReceiptBtn" onclick="showReceipt('<?php echo $payment_ID; ?>')">View Receipt</button>
        <?php } else { ?>
            <span>Receipt unavailable yet</span>
        <?php } ?>
    </td>
    
    <td class="table-data">
    <span class="status <?php echo strtolower($payment_Status); ?>">
        <?php echo ucfirst($payment_Status); ?>
    </span>
    </td>

    <td class="table-data">
    <div class="button-container">
            <button class="payeditBtn" onclick="update_payment(<?php echo $payment_ID ?>)" title="Edit">
                &#9998; Edit
            </button>
                        
    </div>
    </td>

</tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
            </div>
            <?php include('editPayment.php'); ?>



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
//receipt pop up
function showReceipt(payment_ID) {
    fetch(`./admin-endpoint/get-receipt.php?payment_ID=${payment_ID}`)
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
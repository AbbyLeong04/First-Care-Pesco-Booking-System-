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
    <link rel="stylesheet" href="assets/css/search-Bar.css">
    <link rel="stylesheet" href="assets/css/booking-table.css">
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
      <h2 style="margin-bottom:20px; color: white;">Search Bookings</h2>
      <form class="search-form">
         <label for="filterDate">Date:</label>
         <input type="date" id="filterDate" name="filterDate">
         
         <label for="filterTime">Time:</label>
         <select id="filterTime" name="filterTime">
                    <option value="all">All Times</option>
                    <option value="9:30am - 10:30am">9:30am - 10:30am</option>
                    <option value="10:30am - 11:30am">10:30am - 11:30am</option>
                    <option value="11:30am - 12:30pm">11:30am - 12:30pm</option>
                    <option value="12:30pm - 1:30pm">12:30pm - 1:30pm</option>
                    <option value="1:30pm - 2:30pm">1:30pm - 2:30pm</option>
                    <option value="2:30pm - 3:30pm">2:30pm - 3:30pm</option>
                    <option value="3:30pm - 4:30pm">3:30pm - 4:30pm</option>
                    <option value="4:30pm - 5:30pm">4:30pm - 5:30pm</option>
        </select>
         
         <label for="filterState">State:</label>
         <select id="filterState" name="filterState">
                    <option value="all">All States</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Johor">Johor</option>
        </select>
         
         <button type="button" onclick="filterBookings()">search</button>
      </form>
   </div>
</div>

<script>
function filterBookings() {
   const date = document.getElementById('filterDate').value;
   const time = document.getElementById('filterTime').value;
   const state = document.getElementById('filterState').value;

   // 发送过滤条件到后端
   fetch('./admin-endpoint/filterBookings.php', {
      method: 'POST',
      headers: {
         'Content-Type': 'application/json'
      },
      body: JSON.stringify({ date, time, state })
   })
   .then(response => response.json())
   .then(data => {
      const tableBody = document.querySelector('.table-body');
      tableBody.innerHTML = ''; // 清空之前的记录

      // 动态填充表格内容
      data.forEach(row => {
         tableBody.innerHTML += `
            <tr>
               <td class="table-data">${row.customer_ID}</td>
               <td class="table-data">${row.booking_ID}</td>
               <td class="table-data">${row.booking_Service}</td>
               <td class="table-data">${row.booking_sqft}</td>
               <td class="table-data">${row.booking_Date}</td>
               <td class="table-data">${row.booking_Time}</td>
               <td class="table-data">${row.booking_State}</td>
               <td class="table-data">${row.booking_Location}</td>
               <td class="table-data">${row.booking_Contact}</td>
               <td class="table-data">${row.booking_Email}</td>
               <td class="table-data">
                  <span class="status ${row.booking_Status.toLowerCase()}">${row.booking_Status}</span>
               </td>
               <td class="table-data">
                  <div class="button-container">
                     <button class="bookeditBtn" onclick="update_booking(${row.booking_ID})" title="Edit">&#9998;</button>
                     <button class="bookdeleteBtn" onclick="delete_booking(${row.booking_ID})" title="Delete">&#128465;</button>
                  </div>
               </td>
            </tr>
         `;
      });
   })
   .catch(error => console.error('Error:', error));
}
</script>





            <!-- ================ Booking Details List ================= -->
            <div class="outside">
                <div class="text-upper">

                     <h2 style="font-size:26px;">Bookings Record</h2>
                     <a href="bookings.php"><button class=back-btn style="font-size: 20px;">Back after Search</button></a>
               
            
                </div>
                  

                <div class="table-container">
                    <table class="table">
                      <thead class="header">
                        <tr>
                          <th class="head">User ID</th>
                          <th class="head">Booking ID</th>
                          <th class="head">Service</th>
                          <th class="head">SQFT</th>
                          <th class="head">Date</th>
                          <th class="head">Time</th>
                          <th class="head">State</th>
                          <th class="head">Location</th>
                          <th class="head">Mobile</th>
                          <th class="head">Email</th>
                          <th class="head">Status</th>
                          <th class="head">Editing</th>
                        </tr>
                      </thead>
                      <tbody class="table-body">
                      <?php 
                    
                    $stmt = $conn->prepare("SELECT * FROM `booking` ORDER BY booking_ID DESC");
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $customer_ID = $row['customer_ID'];
                        $booking_ID = $row['booking_ID'];
                        $booking_Service = $row['booking_Service'];
                        $booking_sqft = $row['booking_sqft'];
                        $booking_Date = $row['booking_Date'];
                        $booking_Time = $row['booking_Time'];
                        $booking_State = $row['booking_State'];
                        $booking_Location = $row['booking_Location'];
                        $booking_Contact = $row['booking_Contact'];
                        $booking_Email = $row['booking_Email'];
                        $booking_Status = $row['booking_Status'];

                    ?>

                    <tr>
                        <td class="table-data" id="customer_ID-<?= $booking_ID ?>"><?php echo $customer_ID ?></td>
                        <td class="table-data" id="booking_ID-<?= $booking_ID ?>"><?php echo $booking_ID ?></td>
                        <td class="table-data" id="booking_Service-<?= $booking_ID ?>"><?php echo $booking_Service ?></td>
                        <td class="table-data" id="booking_sqft-<?= $booking_ID ?>"><?php echo $booking_sqft ?></td>
                        <td class="table-data" id="booking_Date-<?= $booking_ID ?>"><?php echo $booking_Date ?></td>
                        <td class="table-data" id="booking_Time-<?= $booking_ID ?>"><?php echo $booking_Time ?></td>
                        <td class="table-data" id="booking_State-<?= $booking_ID ?>"><?php echo $booking_State ?></td>
                        <td class="table-data" id="booking_Location-<?= $booking_ID ?>"><?php echo $booking_Location ?></td>
                        <td class="table-data" id="booking_Contact-<?= $booking_ID ?>"><?php echo $booking_Contact ?></td>
                        <td class="table-data" id="booking_Email-<?= $booking_ID ?>"><?php echo $booking_Email ?></td>
                        <td class="table-data">
                           <span class="status <?php echo strtolower($booking_Status); ?>"><?php echo $booking_Status ?></span>
                        </td>

                        <td class="table-data">
                          <div class="button-container">
                            <button class="bookeditBtn" onclick="update_booking(<?php echo $booking_ID ?>)" title="Edit">
                                 &#9998; 
                            </button>
                            <button class="bookdeleteBtn" onclick="delete_booking(<?php echo $booking_ID ?>)" title="Delete">
                                 &#128465; 
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

            <?php include('editBooking.php'); ?>

     
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
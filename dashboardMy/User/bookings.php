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
    <link rel="stylesheet" href="assets/css/book-search.css">
    <link rel="stylesheet" href="assets/css/book-table.css">
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
    <div id="chatbot-tooltip">Hi Dear User!</div>
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
// Function to filter bookings based on date, time, and state
function filterBookings() {
   const date = document.getElementById('filterDate').value;
   const time = document.getElementById('filterTime').value;
   const state = document.getElementById('filterState').value;

   // Send filter data to the server using AJAX
   fetch('./user-endpoint/filterBookings.php', {
      method: 'POST',
      headers: {
         'Content-Type': 'application/json'
      },
      body: JSON.stringify({ date, time, state })
   })
   .then(response => response.json())
   .then(data => {
      const tableBody = document.querySelector('.table-body');
      tableBody.innerHTML = ''; // Clear previous records

      // Populate table with filtered data
      data.forEach(row => {
         tableBody.innerHTML += `
            <tr>
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
                  <button class="editBtn" onclick="update_booking(${row.booking_ID})" title="Edit">&#9998;</button>
                  <button class="deleteBtn" onclick="delete_booking(${row.booking_ID})">&#128465;</button>
               </td>
            </tr>
         `;
      });
   })
   .catch(error => console.error('Error:', error));
}
</script>

<div class="outside">
  <div class="text-upper">

      <a href="bookings.php"><button class="back-btn">Back after Search</button></a>
      <h2>Bookings Details</h2>
      <a href="#" class="booking-btn" id="openModalBtn">Make a booking</a>
    
  </div>
  <?php include('form.php'); ?>

  <div class="table-container">
    <table class="table">
      <thead class="header">
        <tr>
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
        $stmt = $conn->prepare("SELECT * FROM `booking` WHERE `customer_ID` = :customer_ID ORDER BY booking_ID DESC");
        $stmt->bindParam(':customer_ID', $customer_ID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
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
            <td class="table-data"><?php echo $booking_ID ?></td>
            <td class="table-data"><?php echo $booking_Service ?></td>
            <td class="table-data"><?php echo $booking_sqft ?></td>
            <td class="table-data"><?php echo $booking_Date ?></td>
            <td class="table-data"><?php echo $booking_Time ?></td>
            <td class="table-data"><?php echo $booking_State ?></td>
            <td class="table-data"><?php echo $booking_Location ?></td>
            <td class="table-data"><?php echo $booking_Contact ?></td>
            <td class="table-data"><?php echo $booking_Email ?></td>
            <td class="table-data">
              <span class="status <?php echo strtolower($booking_Status); ?>"><?php echo $booking_Status ?></span>
            </td>
            <td class="table-data actions">
              <?php if ($booking_Status != 'confirmed' && $booking_Status != 'completed' && $booking_Status != 'cancelled') { ?>
                <button class="editBtn" onclick="update_booking(<?php echo $row['booking_ID'] ?>)" title="Edit">&#9998;</button>
              <?php } ?>
              <?php if ($booking_Status != 'completed') { ?>
                <button class="deleteBtn" onclick="delete_booking(<?php echo $row['booking_ID'] ?>)">&#128465;</button>
              <?php } ?>
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
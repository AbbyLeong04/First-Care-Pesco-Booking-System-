<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); 
session_start();
if (!isset($_SESSION['admin_ID'])) {
    echo "<script>alert('Please login first.'); window.location.href = 'http://localhost/projectFYP/dashboardMy/user-admin-login-register/admin-log.php'; </script>";
    exit();
}

$admin_ID = $_SESSION['admin_ID'];

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
    <link rel="stylesheet" href="assets/css/form-service.css">
    <link rel="stylesheet" href="assets/css/search-Bar.css">
    <link rel="stylesheet" href="assets/css/home-table.css">
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

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
            <?php

             // 查询 booking 表中的记录数
             $query = "SELECT COUNT(*) as total FROM booking";
             $result = $conn->query($query);

             if ($result) {
               $bookingrow = $result->fetch(PDO::FETCH_OBJ); // 使用 PDO 取回结果
             } else {
               echo "Error: " . $conn->errorInfo()[2]; // 输出数据库错误信息
             }

            ?>

                <div class="card"> 
                   <div>
                       <div class="numbers">
                        <?php echo isset($bookingrow->total) ? $bookingrow->total : 0; // 显示记录总数 ?>
                       </div>
                        <div class="cardName">Bookings</div>
                    </div>
                       

                       <div class="iconBx">
                         <ion-icon name="mail-outline"></ion-icon>
                       </div>
                </div>


                <div class="card">
                <?php
                   $query = "SELECT COUNT(*) as total FROM customer";
                   $result = $conn->query($query);

                   if ($result) {
                    $customerrow = $result->fetch(PDO::FETCH_OBJ); // 使用 PDO 取回结果
                  } else {
                    echo "Error: " . $conn->errorInfo()[2]; // 输出数据库错误信息
                  }

                ?>
                    <div>
                        <div class="numbers"><?php echo isset($customerrow->total) ? $customerrow->total : 0; // 显示记录总数 ?></div>
                        <div class="cardName">Customers</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="bookmarks-outline"></ion-icon>
                    </div>
                </div>


                <div class="card">
                <?php
                   $query = "SELECT COUNT(*) as total FROM payment";
                   $result = $conn->query($query);

                   if ($result) {
                    $paymentrow = $result->fetch(PDO::FETCH_OBJ); // 使用 PDO 取回结果
                  } else {
                    echo "Error: " . $conn->errorInfo()[2]; // 输出数据库错误信息
                  }

                ?>
                    <div>
                        <div class="numbers"><?php echo isset($paymentrow->total) ? $paymentrow->total : 0; // 显示记录总数 ?></div>
                        <div class="cardName">Pay-Record</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                <?php
                   $query = "SELECT COUNT(*) as total FROM contact";
                   $result = $conn->query($query);

                   if ($result) {
                    $contactrow = $result->fetch(PDO::FETCH_OBJ); // 使用 PDO 取回结果
                  } else {
                    echo "Error: " . $conn->errorInfo()[2]; // 输出数据库错误信息
                  }

                ?>
                    <div>
                        <div class="numbers"><?php echo isset($contactrow->total) ? $contactrow->total : 0; // 显示记录总数 ?></div>
                        <div class="cardName">Inbox</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbox-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ search menu ================= -->
<div class="search-modal">
   <div class="search-content">
      <h2 style="margin-bottom:20px; color: white;">Search Availability</h2>
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
         
         <button type="button" onclick="filterAvailable()">search</button>
      </form>
   </div>
</div>

<script>
// Function to filter 
function filterAvailable() {
   const date = document.getElementById('filterDate').value;
   const time = document.getElementById('filterTime').value;
   const state = document.getElementById('filterState').value;

   // Send filter data to the server using AJAX
   fetch('./admin-endpoint/filterAvailable.php', {
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
               <td class="table-data">${row.service_ID}</td>
               <td class="table-data">${row.service_Name}</td>
               <td class="table-data">${row.service_sqft}</td>
               <td class="table-data">${row.service_Date}</td>
               <td class="table-data">${row.service_Time}</td>
               <td class="table-data">${row.service_State}</td>
               <td class="table-data">${row.service_Status}</td>
               <td class="table-data">
                
                            <button class="editBtn" onclick="update_service(${row.service_ID})" title="Edit">
                                 &#9998; Edit
                            </button>
                            <button class="deleteBtn" onclick="delete_service(${row.service_ID})" title="Delete">
                                 &#128465; Delete
                            </button>
              
               </td>
            </tr>
         `;
      });
   })
   .catch(error => console.error('Error:', error));
}
</script>

            <!-- ================ Table list ================= -->
            <div class="outside">
                <div class="text-upper">
             
                   <a href="index.php"><button class="back-btn">Back after Search</button></a>
                   <h2 style="font-size: 26px; text-align: center; flex-grow: 1; color:#140568;">Services Availability Management</h2>
                   <a href="#" id="openModalBtn"><button class="back-btn">Add Availability</button></a>
                
                <?php include('service.php'); ?>
                </div>

                    <div class="table-container">
                      <table class="table">
                        <thread class="header">
                            <tr>
                                <th class="head">Service ID</th>
                                <th class="head">Service</th>
                                <th class="head">Sqft</th>
                                <th class="head">Date</th>
                                <th class="head">Time</th>
                                <th class="head">State</th>
                                <th class="head">Status</th>
                                <th class="head">Editing</th>
                            </tr>
                        </thread>
                        <tbody class="table-body">

                        <?php 
                    
                    $stmt = $conn->prepare("SELECT * FROM `service` ORDER BY service_ID DESC");
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $service_ID = $row['service_ID'];
                        $service_Name = $row['service_Name'];
                        $service_sqft = $row['service_sqft'];
                        $service_Date = $row['service_Date'];
                        $service_Time = $row['service_Time'];
                        $service_State = $row['service_State'];
                        $service_Status = $row['service_Status'];

                    ?>

                    <tr>
                        <td class="table-data" id="service_ID-<?= $service_ID ?>"><?php echo $service_ID ?></td>
                        <td class="table-data" id="service_Name-<?= $service_ID ?>"><?php echo $service_Name ?></td>
                        <td class="table-data" id="service_sqft-<?= $service_ID ?>"><?php echo $service_sqft ?></td>
                        <td class="table-data" id="service_Date-<?= $service_ID ?>"><?php echo $service_Date ?></td>
                        <td class="table-data" id="service_Time-<?= $service_ID ?>"><?php echo $service_Time ?></td>
                        <td class="table-data" id="service_State-<?= $service_ID ?>"><?php echo $service_State ?></td>
                        <td class="table-data" id="service_Status-<?= $service_ID ?>"><?php echo $service_Status ?></td>
                        <td class="table-data">
                      
                            <button class="editBtn" onclick="update_service(<?php echo $service_ID ?>)" title="Edit">
                                 &#9998; Edit
                            </button>
                            <button class="deleteBtn" onclick="delete_service(<?php echo $service_ID ?>)" title="Delete">
                                 &#128465; Delete
                            </button>
                      
                        </td>
                    </tr>    

                    <?php
                    }

                ?>
                     

                        </tbody>
                      </table>
                    </div>
            </div>
            <?php include('editServices.php'); ?>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
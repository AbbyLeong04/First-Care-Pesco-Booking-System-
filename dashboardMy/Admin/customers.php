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
    <link rel="stylesheet" href="assets/css/home-table.css">
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
      <h2 style="margin-bottom:20px; color: white;">Search Customers</h2>
      <form class="search-form">
         <label for="filterID">UserID:</label>
         <input type="text" id="filterID" name="filterID">
         
         <button type="button" onclick="filterCustomers()">search</button>
      </form>
   </div>
</div>

<script>
function filterCustomers() {
   const ID = document.getElementById('filterID').value;

   // Send filter data to the server using AJAX
   fetch('./admin-endpoint/filterCustomers.php', {
      method: 'POST',
      headers: {
         'Content-Type': 'application/json'
      },
      body: JSON.stringify({ ID: ID }) // 保证键名一致
   })
   .then(response => response.json())
   .then(data => {
      const tableBody = document.querySelector('.table-body');
      tableBody.innerHTML = ''; // 清空之前的记录

      // 填充过滤后的数据
      data.forEach(row => {
         tableBody.innerHTML += `
            <tr>
               <td class="table-data">${row.customer_ID}</td>
               <td class="table-data">${row.customer_Name}</td>
               <td class="table-data">${row.customer_Password}</td>
               <td class="table-data">${row.customer_FirstName}</td>
               <td class="table-data">${row.customer_LastName}</td>
               <td class="table-data">${row.customer_Contact}</td>
               <td class="table-data">${row.customer_Email}</td>
               <td class="table-data">
              
                            <button class="editBtn" onclick="update_user(${row.customer_ID})" title="Edit">
                                 &#9998; Edit
                            </button>
                            <button class="deleteBtn" onclick="delete_user(${row.customer_ID})" title="Delete">
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


            <!-- ================ Customer Details List ================= -->
            <div class="outside">
                <div class="text-upper">
               
                    <h2 style="font-size:26px;  color:#140568;">Customers Record</h2>
                    <a href="customers.php"><button class=back-btn style="font-size: 20px;">Back after Search</button></a>
               
                </div>
                  

                <div class="table-container">
                    <table class="table">
                      <thead class="header">
                        <tr>
                          <th class="head">Customer ID</th>
                          <th class="head">Username</th>
                          <th class="head">Password</th>
                          <th class="head">First Name</th>
                          <th class="head">Last Name</th>
                          <th class="head">Mobile</th>
                          <th class="head">Email</th>
                          <th class="head">Editing</th>
                        </tr>
                      </thead>
                      <tbody class="table-body">
                      <?php 
                    
                    $stmt = $conn->prepare("SELECT * FROM `customer` ORDER BY customer_ID DESC");
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

                    <tr>
                        <td class="table-data" id="customer_ID-<?= $customer_ID ?>"><?php echo $customer_ID ?></td>
                        <td class="table-data" id="customer_Name-<?= $customer_ID ?>"><?php echo $customer_Name ?></td>
                        <td class="table-data" id="customer_Password-<?= $customer_ID ?>"><?php echo $customer_Password ?></td>
                        <td class="table-data" id="customer_FirstName-<?= $customer_ID ?>"><?php echo $customer_FirstName ?></td>
                        <td class="table-data" id="customer_LastName-<?= $customer_ID ?>"><?php echo $customer_LastName ?></td>
                        <td class="table-data" id="customer_Contact-<?= $customer_ID ?>"><?php echo $customer_Contact ?></td>
                        <td class="table-data" id="customer_Email-<?= $customer_ID ?>"><?php echo $customer_Email ?></td>
                        <td class="table-data">
                       
                            <button class="editBtn" onclick="update_user(<?php echo $customer_ID ?>)" title="Edit">
                                 &#9998; Edit
                            </button>
                            <button class="deleteBtn" onclick="delete_user(<?php echo $customer_ID ?>)" title="Delete">
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

            <?php include('editCustomer.php'); ?>

        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
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
    <link rel="stylesheet" href="assets/css/touch-bot.css">
    <script src="./assets/js/get-in-touch.js"></script>
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

            <!--Call Record Bot-->
<div class="floatingChat">
    <div class="chatIcon" onclick="toggleChat()">
        <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
    </div>
    <div id="chatPopup" class="chatPopup" style="display: none;">
        <div class="chatHeader">
            <span>Get In Touch Record</span>
            <button class="closeButton" onclick="toggleChat()">&times;</button>
        </div>
        <div class="chatBody">
            <table class="recordsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $stmt = $conn->prepare("SELECT * FROM `user_call` ORDER BY user_ID DESC");
                        $stmt->execute();

                        $result = $stmt->fetchAll();

                        foreach ($result as $row) {
                            $user_ID = $row['user_ID'];
                            $user_Number = $row['user_Number'];
                    ?>
                    <tr id="record-<?= $user_ID ?>">
                        <td id="user_ID-<?= $user_ID ?>"> <?php echo htmlspecialchars($user_ID); ?> </td>
                        <td id="user_Number-<?= $user_ID ?>"> <?php echo htmlspecialchars($user_Number); ?> </td>
                        <td>
                            <button class="deleteButton" onclick="deleteRecord(<?= $user_ID ?>)">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>    
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ================ search menu ================= -->
<div class="search-modal">
   <div class="search-content">
      <h2 style="margin-bottom:20px; color: white;">Search Messages</h2>
      <form class="search-form">
         <label for="filterEmail">Email:</label>
         <input type="email" id="filterEmail" name="filterEmail">
         
         <button type="button" onclick="filterMessages()">search</button>
      </form>
   </div>
</div>

<script>
function filterMessages() {
    const email = document.getElementById('filterEmail').value; // 获取用户输入的 Email

    fetch('./admin-endpoint/filterMessages.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email }) // 传递 JSON 数据
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // 转换为 JSON
    })
    .then(data => {
        const tableBody = document.querySelector('.table-body');
        tableBody.innerHTML = ''; // 清空之前的记录

        data.forEach(row => {
            tableBody.innerHTML += `
                <tr>
                    <td class="table-data">${row.contact_ID}</td>
                    <td class="table-data">${row.contact_Name}</td>
                    <td class="table-data">${row.contact_Email}</td>
                    <td class="table-data">${row.contact_Message}</td>
                    <td class="table-data">
                     <div class="button-container">
                            <button class="deleteBtn" onclick="delete_contact(${row.contact_ID})" title="Delete">
                                 &#128465; Delete
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

            <!-- ================ Msg Details List ================= -->
            <div class="outside">
                <div class="text-upper">
              
                    <h2 style="font-size:26px; color:#140568;">Messages Record</h2>
                    <a href="messages.php"><button class=back-btn style="font-size: 20px;">Back after Search</button></a>
             
                </div>
                  

                <div class="table-container">
                    <table class="table">
                      <thead class="header">
                        <tr>
                          <th class="head">Contact ID</th>
                          <th class="head">Name</th>
                          <th class="head">Email</th>
                          <th class="head">Message</th>
                          <th class="head">Deletion</th>
                        </tr>
                      </thead>
                      <tbody class="table-body">
                      <?php 
                    
                    $stmt = $conn->prepare("SELECT * FROM `contact` ORDER BY contact_ID DESC");
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $contact_ID = $row['contact_ID'];
                        $contact_Name = $row['contact_Name'];
                        $contact_Email = $row['contact_Email'];
                        $contact_Message = $row['contact_Message'];
                    ?>

                    <tr>
                        <td class="table-data" id="contact_ID-<?= $contact_ID ?>"><?php echo $contact_ID ?></td>
                        <td class="table-data" id="contact_Name-<?= $contact_ID ?>"><?php echo $contact_Name ?></td>
                        <td class="table-data" id="contact_Email-<?= $contact_ID ?>"><?php echo $contact_Email ?></td>
                        <td class="table-data" id="contact_Message-<?= $contact_ID ?>"><?php echo $contact_Message ?></td>
                        <td class="table-data">
                        <div class="button-container">
                            <button class="deleteBtn" onclick="delete_contact(<?php echo $contact_ID ?>)" title="Delete">
                                 &#128465; Delete
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
<script>
            // Delete function
function delete_contact(id) {
    if (confirm("Are you sure you want to delete the message?")) {
        window.location.href = "/projectFYP/dashboardMy/Admin/admin-endpoint/delete-contact.php?contact=" + id;
    }
}
</script>
        </div>
    </div>

<script>
function deleteRecord(user_ID) {
    if (confirm('Are you sure you want to delete this record?')) {
        fetch('/projectFYP/dashboardMy/Admin/delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_ID: user_ID }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Debugging: 查看后端返回
            if (data.success) {
                const row = document.getElementById(`record-${user_ID}`);
                if (row) row.remove();
            } else {
                alert('Failed to delete the record. Error: ' + data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

</script>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
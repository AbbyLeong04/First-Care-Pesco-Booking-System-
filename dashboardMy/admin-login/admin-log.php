<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="screen-1">
  <div style="margin-bottom: 20px; font-size: 20px; font-weight: bold; text-align: center;">
    Admin Login
  </div>

<form action="./endpoint/admin-login.php" method="POST">
  <div class="username" style="margin-top: 20px;">
    <label for="username">Username</label>
      <input type="text" placeholder="Enter your username" id="admin_Name" name="admin_Name" required="">
  </div>

  <div class="password">
    <label for="password">Password</label>
      <input type="password" placeholder="Enter your password" id="admin_Password" name="admin_Password" class="pas" required="">
      <ion-icon name="eye-outline"></ion-icon>
  </div>

  <div style="margin-top: 20px; display: flex; justify-content: center; align-items: center;">
    <button type="submit" class="login">Login</button>
  </div>

</form>

  <div style="margin-top: 20px; font-size: 10px; font-weight: 20px; text-align: center;">
      First Care Pest Management
  </div>
</div>



<!-- partial -->
  
</body>
</html>

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); 
?>

<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="user-log-regis.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Login & Registration</title>
    </head>
    <body>
        <!--navigation button-->
<div class="nav-wrapper">
            <nav class="nav">
                <div class="nav-logo">
                    <img src="./img/logo.png" alt="">
                </div>
                <div class="nav-menu" id="navMenu">
                    <ul>
                        <li><a href="/projectFYP/main/index.php" class="link">Home</a></li>
                        <li><a href="/projectFYP/main/Services.php" class="link">Services</a></li>
                        <li><a href="/projectFYP/main/Booking.php" class="link">Booking</a></li>
                        <li><a href="/projectFYP/main/Contact.php" class="link">Contact</a></li>
                    </ul>
                </div>
                <div class="nav-button">
                    <a href="user-log.php"><button class="btn white-btn" id="loginBtn">Sign In</button></a>
                    <a href="user-regis.php"><button class="btn" id="registerBtn">Sign Up</button></a>
                </div>
            </nav>
            <!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->
        <div class="login-container" id="login">
            <div class="top">
                <header>User Login</header>
            </div>
            <form action="./user-endpoint/login.php" method="POST">
            <div class="input-box">
                <input type="text" id="customer_Name" name="customer_Name" class="input-field" placeholder="Username" required="required">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" id="customer_Password" name="customer_Password" class="input-field" placeholder="Password" required="required">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In">
            </div>
            </form>
            <div class="two-col">
                <div class="two">
                    <label><a href="user-regis.php">Don't have account?</a></label>
                </div>
                <div class="two">
                    <label><a href="#" onclick="openForgotPasswordModal()">Forgot password?</a></label>
                </div>
            </div>
        </div>
    </div>
</div>  

    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="pas-modal" style="display: none;">
  <div class="pas-modal-content">
    <span class="pas-close-btn" onclick="closeForgotPasswordModal()">&times;</span>
    <h2>Recover Your Account</h2>
    <form id="forgotPasswordForm">
      <label for="email">Registered Email:</label>
      <input type="email" id="customer_Email" placeholder="Enter your email" required>
      
      <label for="school">Secondary School:</label>
      <input type="text" id="school" placeholder="Enter your secondary school" required>
      
      <label for="gender">Gender:</label>
      <select id="gender">
        <option value="male">male</option>
        <option value="female">female</option>
      </select>
      
      <label for="secret">Father's Name:</label>
      <input type="text" id="secret" placeholder="Enter your father's name" required>
      
      <button type="button" onclick="submitForgotPassword()">Submit</button>
    </form>
    <p id="forgotPasswordMessage" style="color: red;"></p>
  </div>
</div>

<script>
  let failedAttempts = 0;
  let lockTimer;

  function openForgotPasswordModal() {
    if (failedAttempts >= 3) {
      alert("Too many failed attempts. Please try again in 2 minutes.");
      return;
    }
    document.getElementById("forgotPasswordModal").style.display = "block";
  }

  function closeForgotPasswordModal() {
    document.getElementById("forgotPasswordModal").style.display = "none";
  }

  function submitForgotPassword() {
    if (failedAttempts >= 3) {
      alert("Too many failed attempts. Please wait.");
      return;
    }

    const customer_Email = document.getElementById("customer_Email").value;
    const school = document.getElementById("school").value;
    const gender = document.getElementById("gender").value;
    const secret = document.getElementById("secret").value;

    fetch("/projectFYP/dashboardMy/user-admin-login-register/user-endpoint/forgot_password.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ customer_Email, school, gender, secret })
    })
      .then(response => response.json())
      .then(data => {
        const messageElement = document.getElementById("forgotPasswordMessage");
        if (data.success) {
          alert("Account recovery successful! Redirecting...");
          window.location.href = "/projectFYP/dashboardMy/User/index.php";
        } else {
          failedAttempts++;
          messageElement.textContent = data.error || "Invalid information provided.";
          if (failedAttempts >= 3) {
            lockForm();
          }
        }
      })
      .catch(error => console.error("Error:", error));
  }

  function lockForm() {
    alert("Too many failed attempts. Please wait 2 minutes.");
    document.getElementById("forgotPasswordForm").reset();
    document.getElementById("forgotPasswordForm").style.pointerEvents = "none";
    lockTimer = setTimeout(() => {
      failedAttempts = 0;
      document.getElementById("forgotPasswordForm").style.pointerEvents = "auto";
    }, 120000); // 2 minutes lock
  }
</script>


    </body>
</html>
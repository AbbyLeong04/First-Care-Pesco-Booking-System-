<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="user-log-regis.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Login & Registration</title>
</head>
<body>
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
                    <a href="user-log.php"><button class="btn" id="loginBtn">Sign In</button></a>
                    <a href="user-regis.php"><button class="btn white-btn" id="registerBtn">Sign Up</button></a>
                </div>
            </nav>
        <!------------------- registration form -------------------------->
    <div class="regis-wrapper">
        <div class="register-container" id="register">
            <div class="top">
                <span>Have an account? <a href="user-log.php">Login</a></span>
                <header>Sign Up</header>
            </div>
        <form action="./user-endpoint/add-user.php" method="POST">
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" id="customer_FirstName" name="customer_FirstName" class="input-field" placeholder="Firstname" required="required">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" id="customer_LastName" name="customer_LastName" class="input-field" placeholder="Lastname" required="required">
                    <i class="bx bx-user"></i>
                </div>
            </div>

            
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" id="customer_Name" name="customer_Name" class="input-field" placeholder="Username" required="required">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                  <input type="password" id="customer_Password" name="customer_Password" class="input-field" placeholder="Password (8char+num)" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}" required="required">
                  <i class="bx bx-lock-alt"></i>
                </div>
            </div>

            <div class="two-forms">
                <div class="input-box">
                    <input type="text" id="customer_Contact" name="customer_Contact" class="input-field" placeholder="Mobile Number" pattern="(\+60|0)[1-9][0-9]{1}-?[0-9]{7,8}" required="required">
                    <i class="bx bx-phone"></i>
                </div>
                <div class="input-box">
                <input type="email" id="customer_Email" name="customer_Email" class="input-field" placeholder="Email" required="required">
                <i class="bx bx-envelope"></i>
                </div>
            </div>
    
            <div class="input-box">
                <input type="submit" class="submit" value="Register">
            </div>
        </form>   
        </div>
    </div>
</div>

<script>
document.getElementById("customer_Contact").addEventListener("input", function () {
    // 自动清理多余空格和符号
    this.value = this.value.replace(/\s+/g, '').replace(/[^0-9+]/g, '');
});
</script>
</body>
</html>
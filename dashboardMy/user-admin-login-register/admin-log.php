<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); ?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="user-log-regis.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Admin Login</title>
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
            </nav>
            <!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->
        <div class="login-container" id="login">
            <div class="top">
                <header>Admin Login</header>
            </div>
            <form action="./admin-endpoint/admin-login.php" method="POST">
            <div class="input-box">
                <input type="text" id="admin_Name" name="admin_Name" class="input-field" placeholder="Username" required="required">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" id="admin_Password" name="admin_Password" class="input-field" placeholder="Password" required="required">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In">
            </div>
            </form>
        </div>
    </div>
</div>  


    </body>
</html>
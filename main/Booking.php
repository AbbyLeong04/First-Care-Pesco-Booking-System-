<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="ANT TREATMENT​">
    <meta name="description" content="">
    <title>Booking</title>
    <link rel="stylesheet" href="Main_css/nice-page.css" media="screen">
    <link rel="stylesheet" href="Main_css/Booking.css" media="screen">
    <link rel="stylesheet" href="Main_css/chatBot.css" media="screen">
    <link rel="stylesheet" href="Main_css/notice.css" media="screen">
    <link rel="stylesheet" href="Main_css/main-footer.css" media="screen">
    <script src="chatbot.js"></script>
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.19.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
    
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"sameAs": [
				"https://facebook.com/name"
		]
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Booking">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en"><header class=" u-border-no-bottom u-border-no-left u-border-no-right u-border-no-top u-header u-section-row-container" id="sec-6b04" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="" style=""><div class="u-section-rows">
        <div class="u-section-row u-sticky u-white" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="" id="sec-2427">
          
          
          
        <style>
   @media (max-width: 939px) {
       /* 提升导航菜单的层级，仅在移动设备生效 */
       nav.u-menu {
           z-index: 10000 !important; /* 菜单层级 */
           position: relative; /* 保持与页面其他元素的关系 */
       }

       .u-sidenav {
           z-index: 10001 !important; /* 侧边栏固定且在遮罩层之上 */
           position: fixed; /* 确保侧边栏位置固定 */
       }

       .u-menu-overlay {
           z-index: 10000 !important; /* 遮罩层固定 */
           position: fixed; /* 确保遮罩层覆盖页面内容 */
       }
   }
</style>   
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          <div class="u-clearfix u-sheet u-valign-middle-sm u-sheet-1">
            <img class="custom-expanded u-image u-image-contain u-image-default u-image-1" src="images/image.png" alt="" data-image-width="300" data-image-height="200">
            <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1" data-animation-name="fadeIn" data-animation-duration="1000" data-animation-delay="0" data-responsive-from="MD">
              <div class="menu-collapse u-custom-font u-font-roboto" style="font-size: 1.125rem; letter-spacing: 0px; text-transform: uppercase; font-weight: 700;">
                <a class="u-button-style u-custom-active-border-color u-custom-active-color u-custom-border u-custom-border-color u-custom-borders u-custom-hover-border-color u-custom-hover-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-text-shadow u-custom-top-bottom-menu-spacing u-file-icon u-nav-link u-text-active-custom-color-1 u-text-hover-custom-color-9 u-file-icon-1" href="#">
                  <img src="images/157936.png" alt="">
                </a>
              </div>
              <div class="u-custom-menu u-nav-container">
                <ul class="u-custom-font u-font-roboto u-nav u-spacing-2 u-unstyled u-nav-1" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-direction=""><li class="u-nav-item"><a class="u-active-custom-color-1 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-button-style u-hover-custom-color-5 u-nav-link u-text-active-white u-text-custom-color-1 u-text-hover-white" href="index.php" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-active-custom-color-1 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-button-style u-hover-custom-color-5 u-nav-link u-text-active-white u-text-custom-color-1 u-text-hover-white" href="Services.php" style="padding: 10px 20px;">Services</a>
</li><li class="u-nav-item"><a class="u-active-custom-color-1 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-button-style u-hover-custom-color-5 u-nav-link u-text-active-white u-text-custom-color-1 u-text-hover-white" href="Booking.php" style="padding: 10px 20px;">Booking</a>
</li><li class="u-nav-item"><a class="u-active-custom-color-1 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-button-style u-hover-custom-color-5 u-nav-link u-text-active-white u-text-custom-color-1 u-text-hover-white" href="Contact.php" style="padding: 10px 20px;">Contact</a>
</li></ul>
              </div>
              <div class="u-custom-menu u-nav-container-collapse">
                <div class="u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav u-white u-sidenav-1" data-offcanvas-width="174">
                  <div class="u-inner-container-layout u-sidenav-overflow">
                    <div class="u-menu-close"></div>
                    <ul class="u-align-left u-custom-font u-font-roboto u-nav u-popupmenu-items u-text-active-custom-color-5 u-text-custom-color-1 u-text-hover-palette-2-dark-1 u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="index.php">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Services.php">Services</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Booking.php">Booking</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Contact.php">Contact</a>
</li></ul>
                  </div>
                </div>
                <div class="u-menu-overlay u-opacity u-opacity-70"></div>
              </div>
              <style class="menu-style">@media (max-width: 939px) {
                    [data-responsive-from="MD"] .u-nav-container {
                        display: none;
                    }
                    [data-responsive-from="MD"] .menu-collapse {
                        display: block;
                    }
                }</style>
            </nav>
            <a href="../dashboardMy/user-admin-login-register/user-log.php" class="u-btn u-button-style u-custom-font u-font-roboto u-hover-feature u-none u-text-custom-color-1 u-text-hover-custom-color-5 u-btn-1"><span class="u-file-icon u-icon u-text-custom-color-1 u-icon-1"><img src="images/1077063-48ca4a22.png" alt=""></span>&nbsp;Login
            </a>
          </div>
          
        </div>
        <div class="u-section-row" id="sec-42f1">
          <div class="u-clearfix u-sheet u-sheet-2"></div>
          
          
          
          
          
        </div>
      </div>
    <!-- Chatbot Icon -->
<div id="chatbot-icon" onclick="toggleChat()">
    <div id="icon-logo">🤖</div>
    <div id="chatbot-tooltip">Hi There!</div>
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
    
    
    </header>

    <section>
    <div class="u-sheet">
        <!-- Header Section -->
        <div class="u-align-center u-mb-40">
            <h1>Booking Notice</h1>
        </div>

        <!-- Operating Hours and Service Area Sections in Flex Container -->
        <div class="u-flex-container">
            <div class="u-text">
                <h2>Operating Hours:</h2>
                <p>
                    <strong>Monday to Saturday:</strong> 9:00 AM - 5:30 PM<br>
                    <strong>Sunday:</strong> Closed
                </p>
            </div>

            <div class="u-text">
                <h2>Service Area:</h2>
                <p>Kuala Lumpur, Selangor, Johor</p>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="u-align-center">
            <a href="../dashboardMy/user-admin-login-register/user-log.php" class="button-style">Book Now</a>
            <p>
                Don’t have an account? <a href="../dashboardMy/user-admin-login-register/user-regis.php">Register here</a>
            </p>
        </div>
    </div>
</section>


    
    
    
<footer class="footer">
  <div class="footer-container">
    <!-- About Us Section -->
    <div class="footer-section about-us">
      <h3 class="footer-title">About Us</h3>
      <p style="color:white">We provide professional pest control services. Your satisfaction is our priority!</p>
      <a href="Services.php" class="footer-link">Explore Our Services</a><br>
      <a href="/projectFYP/dashboardMy/user-admin-login-register/admin-log.php" class="footer-link">Admin Login</a>
    </div>

    <!-- Get in Touch Section -->
    <div class="footer-section get-in-touch">
      <h3 class="footer-title">Get in Touch</h3>
      <form action="./main-endpoint/add-num.php" method="POST">
        <label for="user_Number" class="form-label">Phone Number</label>
        <input type="tel" id="user_Number" name="user_Number" placeholder="+6012-3456789 or 012-3456789" 
          class="form-input" 
          pattern="(\+60|0)[1-9][0-9]{1}-?[0-9]{7,8}" required>
        <button type="submit" class="form-submit-btn">Submit</button>
      </form>
    </div>

    <!-- Location and Social Icons Section -->
    <div class="footer-section location">
      <h3 class="footer-title">Location</h3>
      <p style="color:white">
        29-G, Jalan Orkid 4, Taman Orkid,<br>
        43200 Cheras, Selangor, Malaysia.
      </p>
      <div class="social-icons">
        <a href="https://www.facebook.com/firstcarepest" target="_blank">
          <div class="icon-fb-ig">
          <ion-icon name="logo-facebook"></ion-icon>
          </div>
        </a>
        <a href="https://www.instagram.com/firstcare_pestcontrol/" target="_blank">
          <div class="icon-fb-ig">
          <ion-icon name="logo-instagram"></ion-icon>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p style="color:white">© 2023-2024 First Care Pest Control Services. All rights reserved.<br>
      <a href="https://www.1stcare.com.my/privacypolicy" class="footer-link">Privacy Policy</a> |
      <a href="https://www.newpages.com.my/v2/en/company/820733/index.html" target="_blank" class="footer-link">Powered by ABBYLEONG</a>
    </p>
  </div>
</footer>

 <!-- ====== ionicons ======= -->
 <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
document.getElementById("booking_Contact").addEventListener("input", function () {
    // 自动清理多余空格和符号
    this.value = this.value.replace(/\s+/g, '').replace(/[^0-9+]/g, '');
});
</script>
</body></html>
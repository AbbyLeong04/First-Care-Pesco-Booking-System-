<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); ?>
<!DOCTYPE html>

<style>
/* 通用样式 */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.update-btn {
    width: 100%;
    background-color: #140a61;
    color: white;
    margin-top: 20px;
    border: none;
    padding: 10px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.update-btn:hover {
    background-color: #302575;
}

/* 模态框样式 */
.cus-modal {
    display: none; /* 默认隐藏 */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px); /* 背景模糊 */
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.cus-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
}

.cus-close-btn {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
}

.cus-close-btn:hover{
    color: hsl(211, 52%, 87%);
}

 /* 表单标签样式 */
 #updateCustomerForm label {
    font-weight: bold;
    margin-bottom: 4px;
    color: #555;
}

/* 表单输入框样式 */
#updateCustomerForm input[type="text"],
#updateCustomerForm input[type="password"],
#updateCustomerForm input[type="email"],
#updateCustomerForm input[type="date"],
#updateCustomerForm select {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

/* 响应式布局 */
@media (max-width: 768px) {
    .cus-modal-content {
        width: 95%; /* 小屏幕时模态框更窄 */
    }

    button {
        font-size: 14px;
    }
}

/* 模态框显示的淡入动画 */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<!-- 模态框结构 -->
<div id="updateCustomerModal" class="cus-modal">
    <div class="cus-modal-content">
        <span class="cus-close-btn" onclick="closeModal()">&times;</span>
        <h2 style="margin-bottom:10px">Customer Info Editing</h2>
<form id="updateCustomerForm" action="/projectFYP/dashboardMy/Admin/admin-endpoint/update-customer.php" method="POST">

    <input type="hidden" id="updateCustomer_ID" name="customer_ID">

    <label for="updateCustomer_Name">Username:</label>
    <input type="text" id="updateCustomer_Name" name="customer_Name" placeholder="Update the Username">

    <label for="updateCustomer_Password">Password:</label>
    <div style="display: flex; align-items: center; position: relative;">
        <input type="password" placeholder="Update the User Password" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}" id="updateCustomer_Password" name="customer_Password">
    </div>

    <label for="updateCustomer_FirstName">First Name:</label>
    <input type="text" id="updateCustomer_FirstName" name="customer_FirstName" placeholder="Update the User First Name">

    <label for="updateCustomer_LastName">Last Name:</label>
    <input type="text" id="updateCustomer_LastName" name="customer_LastName" placeholder="Update the User Last Name">

    <label for="updateCustomer_Contact">Mobile Phone:</label>
    <input type="text" id="updateCustomer_Contact" name="customer_Contact" pattern="(\+60|0)[1-9][0-9]{1}-?[0-9]{7,8}" placeholder="Update the User Mobile">

    <label for="updateCustomer_Email">Email:</label>
    <input type="email" id="updateCustomer_Email" name="customer_Email" placeholder="Update the User Email">

    <button type="submit" class="update-btn">UPDATE</button>
</form>
    </div>
</div>

<script>
    // Update user modal
function update_user(id) {
    $("#updateCustomerModal").css("display", "block");
    $("#updateCustomer_ID").val(id);
}

// Close modal
function closeModal() {
    $("#updateCustomerModal").css("display", "none");
}

// Delete function
function delete_user(id) {
    if (confirm("Are you sure you want to delete the user?")) {
        window.location.href = "/projectFYP/dashboardMy/Admin/admin-endpoint/delete-customer.php?customer=" + id;
    }
}


    // 关闭模态框的点击事件
    window.onclick = function(event) {
        if (event.target == document.getElementById('updateCustomerModal')) {
            closeModal();
        }
    }
</script>

<script>
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById("updateCustomer_Password");
    const toggleIcon = document.getElementById("togglePasswordIcon");

    if (passwordInput.type === "password") {
      passwordInput.type = "text"; // 显示密码
      toggleIcon.classList.remove("fa-eye");
      toggleIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password"; // 隐藏密码
      toggleIcon.classList.remove("fa-eye-slash");
      toggleIcon.classList.add("fa-eye");
    }
  }
</script>
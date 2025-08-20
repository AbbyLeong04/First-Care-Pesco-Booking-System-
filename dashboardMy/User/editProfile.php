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
    justify-content: center;
    align-items: center;
    z-index: 9999; /* 确保模态框处于页面的最上层 */
}

.cus-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 10000; /* 确保内容不被其他样式影响 */
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
#updateCustomerForm input[type="tel"],
#updateCustomerForm input[type="password"],
#updateCustomerForm input[type="text"],
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
  
/* For tablets and larger screens */
@media (max-width: 768px) {
    .cus-modal-content {
        width: 80%;
        padding: 15px;
    }

    #updateCustomerForm {
        gap: 10px;
    }

    #updateCustomerForm label {
        font-size: 13px;
    }

    #updateCustomerForm input[type="tel"],
    #updateCustomerForm input[type="password"],
    #updateCustomerForm input[type="text"],
    #updateCustomerForm input[type="email"],
    #updateCustomerForm input[type="date"],
    #updateCustomerForm select {
        padding: 10px;
        font-size: 13px;
    }

    .update-btn {
        padding: 8px;
        font-size: 15px;
    }
}

/* For mobile phones */
@media (max-width: 480px) {
    .cus-modal-content {
        width: 90%;
        padding: 10px;
    }

    #updateCustomerForm {
        gap: 8px;
    }

    #updateCustomerForm label {
        font-size: 12px;
    }

    #updateCustomerForm input[type="tel"],
    #updateCustomerForm input[type="password"],
    #updateCustomerForm input[type="text"],
    #updateCustomerForm input[type="email"],
    #updateCustomerForm input[type="date"],
    #updateCustomerForm select {
        padding: 8px;
        font-size: 12px;
    }

    .update-btn {
        padding: 6px;
        font-size: 14px;
    }

}

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<!-- 模态框结构 -->
<div id="updateCustomerModal" class="cus-modal">
    <div class="cus-modal-content">
        <span class="cus-close-btn" onclick="closeModal()">&times;</span>
        <h2 style="margin-bottom:10px">Profile Info Editing</h2>
<form id="updateCustomerForm" action="/projectFYP/dashboardMy/User/user-endpoint/update-profile.php" method="POST">

    <input type="hidden" id="updateCustomer_ID" name="customer_ID">

    <label for="updateCustomer_Name">Username:</label>
    <input type="text" id="updateCustomer_Name" name="customer_Name" placeholder="Enter an username">

    <label for="updateCustomer_Password">Password:</label>
    <div style="display: flex; align-items: center; position: relative;">
              <input type="password" id="updateCustomer_Password" name="customer_Password"  placeholder="Enter a password" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}">
    </div>

    <label for="updateCustomer_FirstName">First Name:</label>
    <input type="text" id="updateCustomer_FirstName" name="customer_FirstName"  placeholder="Enter your first name">

    <label for="updateCustomer_LastName">Last Name:</label>
    <input type="text" id="updateCustomer_LastName" name="customer_LastName"  placeholder="Enter your last name">

    <label for="updateCustomer_Contact">Mobile Phone:</label>
    <input type="tel" id="updateCustomer_Contact" name="customer_Contact" pattern="(\+60|0)[1-9][0-9]{1}-?[0-9]{7,8}"  placeholder="Enter a valid mobile number">
    <small>Format: +6012-3456789 or 012-3456789</small><br><br>

    

    <label for="updateCustomer_Email">Email:</label>
    <input type="email" id="updateCustomer_Email" name="customer_Email"  placeholder="Enter a valid email">

    <button type="submit" class="update-btn">UPDATE</button>
</form>
    </div>
</div>

<script>
document.getElementById("booking_Contact").addEventListener("input", function () {
    // 自动清理多余空格和符号
    this.value = this.value.replace(/\s+/g, '').replace(/[^0-9+]/g, '');
});
</script>

<script>

document.addEventListener("DOMContentLoaded", function () {
    // 显示模态框
    function update_customer(id) {
        const modal = document.getElementById("updateCustomerModal");
        modal.style.display = "flex"; // 显示模态框
        modal.style.zIndex = "9999"; // 设置z-index
        document.getElementById("updateCustomer_ID").value = id; // 设置隐藏字段
    }

    // 关闭模态框
    function closeModal() {
        const modal = document.getElementById("updateCustomerModal");
        modal.style.display = "none"; // 隐藏模态框
    }

    // 绑定关闭按钮点击事件
    document.querySelector('.cus-close-btn').addEventListener('click', closeModal);

    // 点击模态框外部时关闭
    window.addEventListener('click', function (event) {
        const modal = document.getElementById("updateCustomerModal");
        if (event.target === modal) {
            closeModal();
        }
    });

    // 删除用户的函数
    function delete_customer(id) {
        if (confirm("Are you sure you want to delete your account?")) {
            window.location.href = "/projectFYP/dashboardMy/User/user-endpoint/delete-profile.php?customer=" + id;
        }
    }

    // 将函数绑定到全局（如果需要在 HTML 内直接调用）
    window.update_customer = update_customer;
    window.delete_customer = delete_customer;
});

</script>
 
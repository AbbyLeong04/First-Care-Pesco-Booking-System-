<?php 
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
/* 通用样式 */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* 更新按钮样式 */
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
.book-modal {
    display: none; /* 默认隐藏 */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px); /* 背景模糊 */
    display: flex; /* 使用 Flexbox 布局 */
    justify-content: center; /* 水平居中 */
    align-items: center; /* 垂直居中 */
    z-index: 1000;
}

/* 模态框内容样式 */
.book-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
    max-height: 80vh; /* 限制模态框高度 */
    overflow-y: auto; /* 垂直滚动 */
    animation: fadeIn 0.3s ease; /* 淡入动画 */
}

/* 关闭按钮样式 */
.book-close-btn {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
}

.book-close-btn:hover {
    color: hsl(211, 52%, 87%);
}

/* 表单标签样式 */
#updateBookingForm label {
    font-weight: bold;
    margin-bottom: 4px;
    color: #555;
}

/* 表单输入框样式 */
#updateBookingForm input[type="text"],
#updateBookingForm input[type="email"],
#updateBookingForm input[type="date"],
#updateBookingForm select {
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
    .book-modal-content {
        width: 95%; /* 小屏幕时模态框更窄 */
    }

    button {
        font-size: 14px;
    }
}

/* 淡入动画 */
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
</head>
<body>
<!-- 模态框结构 -->
<div id="updateBookingModal" class="book-modal">
    <div class="book-modal-content">
        <span class="book-close-btn" onclick="closeModal()">&times;</span>
        <h2 style="margin-bottom:10px">Booking Editing</h2>
<form id="updateBookingForm" action="/projectFYP/dashboardMy/Admin/admin-endpoint/update-booking.php" method="POST">

    <input type="hidden" id="updateBooking_ID" name="booking_ID">
    <input type="hidden" id="updateCustomer_ID" name="customer_ID">
    <input type="hidden" name="original_value" value="<?= $current_value ?>">

    <label for="updateBooking_Service">Service:</label>
    <select id="updateBooking_Service" name="booking_Service">
        <option value="">-- Keep Current --</option> <!-- 保持原值 -->
        <option value="Ant Treatment">Ant Treatment</option>
        <option value="Termite Treatment">Termite Treatment</option>
        <option value="Rodent Treatment">Rodent Treatment</option>
        <option value="Fly Treatment">Fly Treatment</option>
        <option value="Cockroach Treatment">Cockroach Treatment</option>
        <option value="Bed Bugs Treatment">Bed Bugs Treatment</option>
        <option value="Mosquito Treatment">Mosquito Treatment</option>
        <option value="Disinfection Service">Disinfection Service</option>
    </select>

    <label for="updateBooking_sqft">SQFT:</label>
    <select id="updateBooking_sqft" name="booking_sqft">
        <option value="">-- Keep Current --</option> 
        <option value="1500sqft Below">1500sqft Below</option>
        <option value="2000sqft Below">2000sqft Below</option>
        <option value="2500sqft Below">2500sqft Below</option>
        <option value="3000sqft Below">3000sqft Below</option>
        <option value="4000sqft Below">4000sqft Below</option>
        <option value="5000sqft Below">5000sqft Below</option>
        <option value="10,000sqft Below">10,000sqft Below</option>
        <option value="10,000sqft Above">10,000sqft Above</option>
    </select>

    <label for="updateBooking_Date">Date:</label>
    <input type="date" id="updateBooking_Date" name="booking_Date">

    <label for="updateBooking_Time">Time:</label>
    <select id="updateBooking_Time" name="booking_Time">
        <option value="">-- Keep Current --</option> 
        <option value="9:30am - 10:30am">9:30am - 10:30am</option>
        <option value="10:30am - 11:30am">10:30am - 11:30am</option>
        <option value="11:30am - 12:30pm">11:30am - 12:30pm</option>
        <option value="12:30pm - 1:30pm">12:30pm - 1:30pm</option>
        <option value="1:30pm - 2:30pm">1:30pm - 2:30pm</option>
        <option value="2:30pm - 3:30pm">2:30pm - 3:30pm</option>
        <option value="3:30pm - 4:30pm">3:30pm - 4:30pm</option>
        <option value="4:30pm - 5:30pm">4:30pm - 5:30pm</option>
    </select>

    <label for="updateBooking_State">State:</label>
    <select id="updateBooking_State" name="booking_State">
        <option value="">-- Keep Current --</option> 
        <option value="Kuala Lumpur">Kuala Lumpur</option>
        <option value="Selangor">Selangor</option>
        <option value="Johor">Johor</option>
    </select>

    <label for="updateBooking_Location">Location:</label>
    <input type="text" id="updateBooking_Location" name="booking_Location" placeholder="Update the Location">

    <label for="updateBooking_Contact">Mobile Phone:</label>
    <input type="text" id="updateBooking_Contact" name="booking_Contact" pattern="(\+60|0)[1-9][0-9]{1}-?[0-9]{7,8}" placeholder="Update the Mobile Number">

    <label for="updateBooking_Email">Email:</label>
    <input type="email" id="updateBooking_Email" name="booking_Email" placeholder="Update the Email">

    <label for="updateBooking_Status">Status:</label>
    <select id="updateBooking_Status" name="booking_Status">
        <option value="pending">pending</option>
        <option value="confirmed">confirmed</option>
        <option value="completed">completed</option>
        <option value="cancelled">cancelled</option>
    </select>


    <button type="submit" class="update-btn">UPDATE</button>
</form>
    </div>
</div>


<script>
    // 页面加载时隐藏模态框
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("updateBookingModal").style.display = "none";
    });

    // 显示模态框的函数
    function update_booking(id) {
        if (id) { // 确保传递了有效的 id
            document.getElementById("updateBookingModal").style.display = "block";
            document.getElementById("updateBooking_ID").value = id;
        }
    }

    // 关闭模态框的函数
    function closeModal() {
        document.getElementById("updateBookingModal").style.display = "none";
    }

    // Delete function
function delete_booking(id) {
    if (confirm("Are you sure you want to delete the booking?")) {
        window.location.href = "/projectFYP/dashboardMy/Admin/admin-endpoint/delete-booking.php?booking=" + id;
    }
}

    // 点击页面其他地方时关闭模态框
    window.onclick = function(event) {
        const modal = document.getElementById("updateBookingModal");
        if (event.target === modal) {
            closeModal();
        }
    };
</script>
</body>
</html>
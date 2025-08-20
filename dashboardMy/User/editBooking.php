<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php'); ?>
<!DOCTYPE html>

<style>
/* 基本全局字体设置 */
body {
    font-family: Arial, sans-serif;
    color: #333;
}

/* Modal 背景模糊效果 */
.modal{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px); /* 背景模糊效果 */
    z-index: 1000;
}

/* Modal内容容器 */
.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    width: 450px; /* 弹窗宽度 */
    max-height: 90vh; /* 限制高度，防止溢出屏幕 */
    overflow-y: auto; /* 内容过多时启用滚动条 */
    display: flex;
    flex-direction: column;
    gap: 16px; /* 项目间距 */
}

/* 关闭按钮样式 */
.close {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 24px;
    font-weight: bold;
    color: #0c1079;
    cursor: pointer;
    transition: color 0.3s ease;
}

.close:hover {
    color: #d6ceee;
}

/* 表单整体布局 */
#updateBookingForm {
    display: flex;
    flex-direction: column; /* 单列布局 */
    gap: 12px; /* 各字段间距 */
    width: 100%; /* 表单内容填满容器 */
}

/* 单项表单样式 */
#updateBookingForm label {
    font-size: 14px;
    font-weight: bold;
    color: #321a74;
    margin-bottom: 4px; /* 与输入框的间距 */
    align-content: left;
    text-align: left;
    justify-self: left;
}

#updateBookingForm input[type="text"],
#updateBookingForm input[type="tel"],
#updateBookingForm input[type="email"],
#updateBookingForm input[type="date"],
#updateBookingForm select {
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    background-color: #fafafa;
    width: 100%; /* 占满容器 */
    box-sizing: border-box;
    transition: all 0.3s ease;
}

/* 输入框聚焦效果 */
#updateBookingForm input:focus,
#updateBookingForm select:focus {
    outline: none;
    border-color: #744caf;
    box-shadow: 0 0 5px rgba(116, 76, 175, 0.5);
}

/* 提交按钮样式 */
#updateBookingForm button[type="submit"] {
    background-color: #4947da;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px; /* 与表单分隔 */
}

#updateBookingForm button[type="submit"]:hover {
    background-color: #3a38a9;
}

/* For tablets and larger screens */
@media (max-width: 768px) {
    .modal-content {
        width: 80%;
        padding: 15px;
    }

    #updateBookingForm {
        gap: 10px;
    }

    #updateBookingForm label {
        font-size: 13px;
    }

    #updateBookingForm input[type="text"],
    #updateBookingForm input[type="tel"],
    #updateBookingForm input[type="email"],
    #updateBookingForm input[type="date"],
    #updateBookingForm select {
        padding: 10px;
        font-size: 13px;
    }

    #updateBookingForm button[type="submit"] {
        padding: 12px;
        font-size: 15px;
    }
}

/* For mobile phones */
@media (max-width: 480px) {
    .modal-content {
        width: 90%;
        padding: 10px;
    }

    #updateBookingForm {
        gap: 8px;
    }

    #updateBookingForm label {
        font-size: 12px;
    }

    #updateBookingForm input[type="text"],
    #updateBookingForm input[type="tel"],
    #updateBookingForm input[type="email"],
    #updateBookingForm input[type="date"],
    #updateBookingForm select {
        padding: 8px;
        font-size: 12px;
    }

    #updateBookingForm button[type="submit"] {
        padding: 10px;
        font-size: 14px;
    }
}

</style>


<!-- 模态框结构 -->
<div id="updateBookingModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 style="margin-bottom:10px; font-size:20px; color: #321a74;">Booking Editing</h2>
<form id="updateBookingForm" action="/projectFYP/dashboardMy/User/user-endpoint/edit-booking.php" method="POST">

    <input type="hidden" id="updateBooking_ID" name="booking_ID">
    <input type="hidden" id="updateCustomer_ID" name="customer_ID">

    <label for="updateBooking_Service">Service:</label>
    <select id="updateBooking_Service" name="booking_Service">
        <option value="">-- Keep Current --</option> 
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
    <input type="text" id="updateBooking_Location" name="booking_Location" placeholder="Enter a valid location">

    <label for="updateBooking_Contact">Mobile Phone:</label>
    <input type="tel" id="updateBooking_Contact" name="booking_Contact" pattern="(\+60|0)[1-9][0-9]{1}-?[0-9]{7,8}" placeholder="+6012-3456789 or 012-3456789">

    <label for="updateBooking_Email">Email:</label>
    <input type="email" id="updateBooking_Email" name="booking_Email" placeholder="Enter a valid email">

    <button type="submit">UPDATE</button>
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
    // Update user modal
function update_booking(id) {
    $("#updateBookingModal").css("display", "block");
    $("#updateBooking_ID").val(id);
}

// Close modal
function closeModal() {
    $("#updateBookingModal").css("display", "none");
}

// Delete function
function delete_booking(id) {
    if (confirm("Are you sure you want to delete the booking?")) {
        window.location.href = "/projectFYP/dashboardMy/User/user-endpoint/delete-booking.php?booking=" + id;
    }
}


    // 关闭模态框的点击事件
    window.onclick = function(event) {
        if (event.target == document.getElementById('updateBookingModal')) {
            closeModal();
        }
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateField = document.getElementById('updateBooking_Date');
    
    // 获取当前日期，并设置为输入框的最小值
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayString = `${yyyy}-${mm}-${dd}`;

    dateField.setAttribute('min', todayString);
});
</script>

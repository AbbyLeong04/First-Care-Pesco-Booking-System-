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
.index-modal {
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

.index-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
}

.index-close-btn {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
}

.index-close-btn:hover{
    color: hsl(211, 52%, 87%);
}

 /* 表单标签样式 */
 #updateServiceForm label {
    font-weight: bold;
    margin-bottom: 4px;
    color: #555;
}

/* 表单输入框样式 */
#updateServiceForm input[type="text"],
#updateServiceForm input[type="email"],
#updateServiceForm input[type="date"],
#updateServiceForm select {
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
    .index-modal-content {
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

<!-- 模态框结构 -->
<div id="updateServiceModal" class="index-modal">
    <div class="index-modal-content">
        <span class="index-close-btn" onclick="closeModal()">&times;</span>
        <h2 style="margin-bottom:10px">Service Editing</h2>
<form id="updateServiceForm" action="/projectFYP/dashboardMy/Admin/admin-endpoint/update-service.php" method="POST">

    <input type="hidden" id="updateService_ID" name="service_ID">

    <label for="updateService_Name">Service:</label>
    <select id="updateService_Name" name="service_Name">
        <option value="all">All Service</option>
        <option value="Ant Treatment">Ant Treatment</option>
        <option value="Termite Treatment">Termite Treatment</option>
        <option value="Rodent Treatment">Rodent Treatment</option>
        <option value="Fly Treatment">Fly Treatment</option>
        <option value="Cockroach Treatment">Cockroach Treatment</option>
        <option value="Bed Bugs Treatment">Bed Bugs Treatment</option>
        <option value="Mosquito Treatment">Mosquito Treatment</option>
        <option value="Disinfection Service">Disinfection Service</option>
    </select>

    <label for="updateService_sqft">SQFT:</label>
    <select id="updateService_sqft" name="service_sqft">
        <option value="all">All SQFT</option>
        <option value="1500sqft Below">1500sqft Below</option>
        <option value="2000sqft Below">2000sqft Below</option>
        <option value="2500sqft Below">2500sqft Below</option>
        <option value="3000sqft Below">3000sqft Below</option>
        <option value="4000sqft Below">4000sqft Below</option>
        <option value="5000sqft Below">5000sqft Below</option>
        <option value="10,000sqft Below">10,000sqft Below</option>
        <option value="10,000sqft Above">10,000sqft Above</option>
    </select>

    <label for="updateService_Date">Date:</label>
    <input type="date" id="updateService_Date" name="service_Date">

    <label for="updateService_Time">Time:</label>
    <select id="updateService_Time" name="service_Time">
        <option value="all">All Time</option>
        <option value="9:30am - 10:30am">9:30am - 10:30am</option>
        <option value="10:30am - 11:30am">10:30am - 11:30am</option>
        <option value="11:30am - 12:30pm">11:30am - 12:30pm</option>
        <option value="12:30pm - 1:30pm">12:30pm - 1:30pm</option>
        <option value="1:30pm - 2:30pm">1:30pm - 2:30pm</option>
        <option value="2:30pm - 3:30pm">2:30pm - 3:30pm</option>
        <option value="3:30pm - 4:30pm">3:30pm - 4:30pm</option>
        <option value="4:30pm - 5:30pm">4:30pm - 5:30pm</option>
    </select>

    <label for="updateService_State">State:</label>
    <select id="updateService_State" name="service_State">
        <option value="all">All State</option>
        <option value="Kuala Lumpur">Kuala Lumpur</option>
        <option value="Selangor">Selangor</option>
        <option value="Johor">Johor</option>
    </select>

    <label for="updateService_Status">Status:</label>
    <select id="updateService_Status" name="service_Status">
        <option value="unavailable">unavailable</option>
    </select>


    <button type="submit" class="update-btn">UPDATE</button>
</form>
    </div>
</div>

<script>
    // Update user modal
function update_service(id) {
    $("#updateServiceModal").css("display", "block");
    $("#updateService_ID").val(id);
}

// Close modal
function closeModal() {
    $("#updateServiceModal").css("display", "none");
}

// Delete function
function delete_service(id) {
    if (confirm("Are you sure you want to delete the service?")) {
        window.location.href = "/projectFYP/dashboardMy/Admin/admin-endpoint/delete-service.php?service=" + id;
    }
}


    // 关闭模态框的点击事件
    window.onclick = function(event) {
        if (event.target == document.getElementById('updateServiceModal')) {
            closeModal();
        }
    }
</script>

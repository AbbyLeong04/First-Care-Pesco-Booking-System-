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
.pay-modal {
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

.pay-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
}

.pay-close-btn {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
}

.pay-close-btn:hover{
    color: hsl(211, 52%, 87%);
}

 /* 表单标签样式 */
 #updatePayment label {
    font-weight: bold;
    margin-bottom: 4px;
    color: #555;
}

/* 表单输入框样式 */
#updatePayment input[type="text"],
#updatePayment input[type="email"],
#updatePayment input[type="date"],
#updatePayment select {
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
    .pay-modal-content {
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
<div id="updatePayment" class="pay-modal">
    <div class="pay-modal-content">
        <span class="pay-close-btn" onclick="closeModal()">&times;</span>
        <h2 style="margin-bottom:10px">Customer Payment Info Editing</h2>
<form id="updatePayment" action="/projectFYP/dashboardMy/Admin/admin-endpoint/update-payment.php" method="POST">

    <input type="hidden" id="updateBooking_ID" name="booking_ID">
    <input type="hidden" id="updatePayment_ID" name="payment_ID">

    <label for="updatePayment_Price">Total Price:</label>
    <input type="text" id="updatePayment_Price" name="payment_Price" placeholder="Update the Price">

    <label for="updatePayment_Status">Payment Status:</label>
    <select id="updatePayment_Status" name="payment_Status">
        <option value="pending">pending</option>
        <option value="completed">completed</option>
        <option value="cancelled">cancelled</option>
    </select>

    <button type="submit" class="update-btn">UPDATE</button>
</form>
    </div>
</div>

<script>
  const priceInput = document.getElementById('updatePayment_Price');

  priceInput.addEventListener('input', () => {
    let value = priceInput.value.replace(/^RM\s?/, ''); // 移除已有的 'RM'
    priceInput.value = value ? `RM ${value}` : ''; // 如果有值，前面加上 'RM'
  });
</script>

<script>
    // Update
function update_payment(id) {
    $("#updatePayment").css("display", "block");
    $("#updatePayment_ID").val(id);
}

// Close modal
function closeModal() {
    $("#updatePayment").css("display", "none");
}


    // 关闭模态框的点击事件
    window.onclick = function(event) {
        if (event.target == document.getElementById('updatePayment')) {
            closeModal();
        }
    }
</script>



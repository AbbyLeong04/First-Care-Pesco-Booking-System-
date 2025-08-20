<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');?>

<!DOCTYPE html>

<script>
  // 页面内容加载完成后执行
  document.addEventListener('DOMContentLoaded', function() {
    const dateField = document.getElementById('booking_Date');
    const timeField = document.getElementById('booking_Time');
    const stateField = document.getElementById('booking_State');
    const serviceField = document.getElementById('booking_Service');
    const sqftField = document.getElementById('booking_sqft');

    // 初始禁用后续选项
    timeField.disabled = true;
    stateField.disabled = true;
    serviceField.disabled = true;
    sqftField.disabled = true;

    // 用户选择日期后启用时间字段
    dateField.addEventListener('change', async function() {
        timeField.disabled = false;
        stateField.disabled = true;
        serviceField.disabled = true;
        sqftField.disabled = true;
        await updateUnavailableOptions('time');
    });

    // 用户选择时间后启用州字段
    timeField.addEventListener('change', async function() {
        stateField.disabled = false;
        serviceField.disabled = true;
        sqftField.disabled = true;
        await updateUnavailableOptions('state');
    });

    // 用户选择州后启用服务字段
    stateField.addEventListener('change', async function() {
        serviceField.disabled = false;
        sqftField.disabled = true;
        await updateUnavailableOptions('service');
    });

    // 用户选择服务后启用平方英尺字段
    serviceField.addEventListener('change', async function() {
        sqftField.disabled = false;
        await updateUnavailableOptions('sqft');
    });

    async function updateUnavailableOptions(optionType) {
    const date = dateField.value;
    const time = timeField.value;
    const state = stateField.value;
    const service = serviceField.value;
    const sqft = sqftField.value;

    const response = await fetch(`check_availability.php?date=${date}&time=${time}&state=${state}&serviceName=${service}&sqft=${sqft}&optionType=${optionType}`);
    const data = await response.json();

    if (optionType === 'time') {
            [...timeField.options].forEach(option => {
                option.disabled = data.unavailableTimes.includes(option.value);
            });
        } else if (optionType === 'state') {
            [...stateField.options].forEach(option => {
                option.disabled = data.unavailableStates.includes(option.value);
            });
        } else if (optionType === 'service') {
            [...serviceField.options].forEach(option => {
                option.disabled = data.unavailableServices.includes(option.value);
            });
        } else if (optionType === 'sqft') {
            [...sqftField.options].forEach(option => {
                option.disabled = data.unavailableSqft.includes(option.value);
            });
    }
}

  });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    const dateField = document.getElementById('booking_Date');

    // 禁用所有星期日
    dateField.addEventListener('change', function() {
        const selectedDate = new Date(dateField.value);
        if (selectedDate.getDay() === 0) { // getDay() 返回 0 表示星期日
            alert("Sunday is a holiday and booking is unavailable.");
            dateField.value = ""; // 清空日期选择
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const dateField = document.getElementById('booking_Date');

    dateField.addEventListener('change', async function () {
        const selectedDate = dateField.value;
        
        try {
            const response = await fetch(`check_availability.php?date=${selectedDate}&optionType=date`);
            const data = await response.json();

            if (data.unavailableDate) {
                alert("The selected date is unavailable for booking.");
                dateField.value = ""; // 清空日期选择
            }
        } catch (error) {
            console.error("Error fetching availability:", error);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const dateField = document.getElementById('booking_Date');
    
    // 获取当前日期，并设置为输入框的最小值
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayString = `${yyyy}-${mm}-${dd}`;

    dateField.setAttribute('min', todayString);
});

</script>


<!-- Modal Structure -->
<div id="bookingModal" class="book-form-modal">
    <div class="book-form-modal-content">
        <span class="book-form-close-btn">&times;</span>
        <h3 style="font-size: 20px; font-weight: bold; color: #321a74;">Make your Booking</h3>
        <form action="./user-endpoint/add-booking.php" method="POST" class="form-container" onsubmit="return checkAvailability()">
            <div class="book-form-group">
                <label for="booking_Date">Date</label>
                <input type="date" placeholder="MM/DD/YYYY" id="booking_Date" name="booking_Date" required data-date-format="mm/dd/yyyy">
            </div>

            <div class="book-form-group">
                <label for="booking_Time">Time</label>
                <select id="booking_Time" name="booking_Time" required>
                    <option value="9:30am - 10:30am">9:30am - 10:30am</option>
                    <option value="10:30am - 11:30am">10:30am - 11:30am</option>
                    <option value="11:30am - 12:30pm">11:30am - 12:30pm</option>
                    <option value="12:30pm - 1:30pm">12:30pm - 1:30pm</option>
                    <option value="1:30pm - 2:30pm">1:30pm - 2:30pm</option>
                    <option value="2:30pm - 3:30pm">2:30pm - 3:30pm</option>
                    <option value="3:30pm - 4:30pm">3:30pm - 4:30pm</option>
                    <option value="4:30pm - 5:30pm">4:30pm - 5:30pm</option>
                </select>
            </div>

            <div class="book-form-group">
                <label for="booking_State">State</label>
                <select id="booking_State" name="booking_State" required>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Johor">Johor</option>
                </select>
            </div>

            <div class="book-form-group">
                <label for="booking_Service">Services</label>
                <select id="booking_Service" name="booking_Service" required>
                    <option value="Ant Treatment">Ant Treatment</option>
                    <option value="Termite Treatment">Termite Treatment</option>
                    <option value="Rodent Treatment">Rodent Treatment</option>
                    <option value="Fly Treatment">Fly Treatment</option>
                    <option value="Cockroach Treatment">Cockroach Treatment</option>
                    <option value="Bed Bugs Treatment">Bed Bugs Treatment</option>
                    <option value="Mosquito Treatment">Mosquito Treatment</option>
                    <option value="Disinfection Service">Disinfection Service</option>
                </select>
            </div>

            <div class="book-form-group">
                <label for="booking_sqft">Place SQFT</label>
                <select id="booking_sqft" name="booking_sqft" required>
                    <option value="1500sqft Below">1500sqft Below</option>
                    <option value="2000sqft Below">2000sqft Below</option>
                    <option value="2500sqft Below">2500sqft Below</option>
                    <option value="3000sqft Below">3000sqft Below</option>
                    <option value="4000sqft Below">4000sqft Below</option>
                    <option value="5000sqft Below">5000sqft Below</option>
                    <option value="10,000sqft Below">10,000sqft Below</option>
                    <option value="10,000sqft Above">10,000sqft Above</option>
                </select>
            </div>

            <div class="book-form-group">
                    <label for="booking_Location">Location</label>
                    <input type="text" placeholder="Enter the location where you would like to receive service" id="booking_Location" name="booking_Location" required>
            </div>

            <div class="book-form-group">
                    <label for="booking_Email">Email</label>
                    <input type="email" placeholder="Enter a valid email address" id="booking_Email" name="booking_Email" required>
            </div>

            <div class="book-form-group">
                    <label for="booking_Contact">Mobile Phone</label>
                    <input type="tel" 
                    placeholder="Enter a valid mobile number" 
                    id="booking_Contact" 
                    name="booking_Contact" 
                    pattern="(\+60|0)[1-9][0-9]{1}-?[0-9]{7,8}" 
                    required>
                    <small>Format: +6012-3456789 or 012-3456789</small>
            </div>

            <button type="submit" class="book-form-submit-btn">Submit</button>
        </form>
    </div>
</div>


<div id="error-message" class="book-form-error-message" style="display:none;"></div>

<script>
document.getElementById("booking_Contact").addEventListener("input", function () {
    // 自动清理多余空格和符号
    this.value = this.value.replace(/\s+/g, '').replace(/[^0-9+]/g, '');
});
</script>

<style>

.error-message {
    color: red;
    background-color: #f8d7da;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
    font-size: 14px;
    border: 1px solid #f5c6cb;
}


</style>

<script>
  // 打开和关闭模态框的功能代码
  document.getElementById('openModalBtn').addEventListener('click', function (event) {
    event.preventDefault();
    document.getElementById('bookingModal').style.display = 'flex';
  });

  document.querySelector('.book-form-close-btn').addEventListener('click', function () {
    document.getElementById('bookingModal').style.display = 'none';
  });

  window.addEventListener('click', function (event) {
    if (event.target == document.getElementById('bookingModal')) {
      document.getElementById('bookingModal').style.display = 'none';
    }
  });
</script>

<script>
    async function checkAvailability() {
        const booking_Service = document.getElementById('booking_Service').value;
        const booking_Date = document.getElementById('booking_Date').value;
        const booking_Time = document.getElementById('booking_Time').value;
        const booking_State = document.getElementById('booking_State').value;

        const response = await fetch(`check_availability.php?serviceName=${booking_Service}&service_Date=${booking_Date}&service_Time=${booking_Time}&service_State=${booking_State}`);
        const data = await response.json();

        if (data.status === 'unavailable') {
            alert('The booking selection is unavailable!');
            return false;
        }
        return true;
    }
</script>


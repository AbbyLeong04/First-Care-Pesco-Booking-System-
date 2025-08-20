<?php include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');?>
<!DOCTYPE html>
        <!-- Modal Structure -->
        <div id="serviceModal" class="modal">
             <div class="modal-content">
               <span class="close-btn">&times;</span>
               <h3 style="margin-bottom: 20px;">Services Management Form</h3>
                  <form action="./admin-endpoint/unavailability.php" method="POST" class="form-container">

                  <div class="form-group">
                    <label for="service_Date">Date</label>
                    <input type="date" placeholder="MM/DD/YYYY" id="service_Date" name="service_Date"  required data-date-format="mm/dd/yyyy">
                    </div>

                    <div class="form-group">
                    <label for="service_Time">Time</label>
                    <select id="service_Time" name="service_Time" required>
                      <option value="all">All Times</option>
                      <option value="9:30am - 10:30am">9:30am - 10:30am</option>
                      <option value="10:30am - 11:30am">10:30am - 11:30am</option>
                      <option value="11:30am - 12:30pm">11:30am - 12:30pm</option>
                      <option value="12:30pm - 1:30pm">12:30pm - 1:30pm</option>
                      <option value="1:30pm - 2:30pm">1:30pm - 2:30pm</option>
                      <option value="2:30pm - 3:30pm">2:30pm - 3:30pm</option>
                      <option value="3:30pm - 4:30pm">3:30pm - 4:30pm</option>
                      <option value="4:30pm - 5:30pm">4:30pm - 5:30pm</option>
                      <option value="selectAllTime">Select All</option>
                   </select>
                    </div>

                    <div class="form-group">
                    <label for="service_State">State</label>
                    <select id="service_State" name="service_State" required>
                       <option value="all">All States</option>
                       <option value="Kuala Lumpur">Kuala Lumpur</option>
                       <option value="Selangor">Selangor</option>
                       <option value="Johor">Johor</option>
                   </select>
                    </div>

                    <!-- 表单内容保持不变 -->
                  <div class="form-group">
                    <label for="service_Name">Services</label>
                      <select id="service_Name" name="service_Name" required>
                        <option value="all">All Services</option>
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
                   <!-- 继续添加其他表单项 -->
                   <div class="form-group">
                    <label for="service_sqft">Place SQFT</label>
                      <select id="service_sqft" name="service_sqft" required>
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
                    </div>


                    <div class="form-group">
                    <label for="service_Status">Status</label>
                    <select id="service_Status" name="service_Status" required>
                       <option value="unavailable">Unavailable</option>
                    </select>
                    </div>

                  
                   <button type="submit" class="submit-btn">Submit</button>
                   </form>
             </div>

             <script>
               // 打开模态框
               document.getElementById('openModalBtn').addEventListener('click', function (event) {
               event.preventDefault();
               document.getElementById('serviceModal').style.display = 'flex';
               });
 
              // 关闭模态框
              document.querySelector('.close-btn').addEventListener('click', function () {
              document.getElementById('serviceModal').style.display = 'none';
               });

              // 点击模态框外部区域关闭
             window.addEventListener('click', function (event) {
               if (event.target == document.getElementById('serviceModal')) {
                 document.getElementById('serviceModal').style.display = 'none';
                }
               });
             </script>
             </div>

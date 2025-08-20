<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/projectFYP/dashboardMy/conn/conn.php');
?>


<!-- Verification Modal -->
<div id="verifyModal" class="verify-modal" style="display: none;">
  <div class="verify-modal-content">
    <span class="verify-close-btn" onclick="closeVerifyModal()">&times;</span>
    <div id="step1" class="step">
      <h3>Enter Your Password</h3>
      <input type="password" id="customer_Password" placeholder="Enter your password">
      <button onclick="verifyPassword()">Next</button>
    </div>
    <div id="step2" class="step" style="display: none;">
      <h3 style="margin-bottom:20px">Set/Update Your Verification Information for Account Recovery</h3>
      <label>Your Secondary School:</label>
      <input type="text" id="school" placeholder="Enter your secondary school">
      <label>Your Gender:</label>
      <select id="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
      <label>Your Father's Name:</label>
      <input type="text" id="secret" placeholder="Enter your father's name">
      <button onclick="saveVerification()">Save</button>
    </div>
    <div id="info" class="step" style="display: none;">
      <h3 style="margin-bottom:20px">Your Verification Information for Forgot Password</h3>
      <p id="displaySchool" style="margin-bottom:10px"></p>
      <p id="displayGender" style="margin-bottom:10px"></p>
      <p id="displaySecret" style="margin-bottom:10px"></p>
      <button onclick="updateVerification()">Update</button>
    </div>
  </div>
</div>

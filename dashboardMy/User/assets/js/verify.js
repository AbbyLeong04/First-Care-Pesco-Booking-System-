function openVerifyModal() {
    // Check if verification data exists
    fetch("/projectFYP/dashboardMy/User/user-endpoint/check_verification.php")
      .then(response => response.json())
      .then(data => {
        if (data.exists) {
          // Show existing verification info
          document.getElementById("info").style.display = "block";
          document.getElementById("step1").style.display = "none";
          document.getElementById("step2").style.display = "none";
  
          document.getElementById("displaySchool").textContent = "Your Secondary School: " + data.school;
          document.getElementById("displayGender").textContent = "Your Gender: " + data.gender;
          document.getElementById("displaySecret").textContent = "Your Father's Name: " + data.secret;
        } else {
          // Show password input step
          document.getElementById("step1").style.display = "block";
          document.getElementById("step2").style.display = "none";
          document.getElementById("info").style.display = "none";
        }
        document.getElementById("verifyModal").style.display = "block";
      });
  }
  
  function closeVerifyModal() {
    document.getElementById("verifyModal").style.display = "none";
  }

  function verifyPassword() {
    const customer_Password = document.getElementById("customer_Password").value;
  
    fetch("/projectFYP/dashboardMy/User/user-endpoint/verify_password.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ customer_Password }) // 确保字段名匹配后端
    })
      .then(response => response.json())
      .then(data => {
        console.log(data); // 检查返回值是否正确
        if (data.success) {
          document.getElementById("step1").style.display = "none";
          document.getElementById("step2").style.display = "block";
        } else {
          alert("Incorrect password!");
        }
      })
      .catch(error => console.error("Error:", error));
}
  
  
  function saveVerification() {
    const school = document.getElementById("school").value;
    const gender = document.getElementById("gender").value;
    const secret = document.getElementById("secret").value;
  
    fetch("/projectFYP/dashboardMy/User/user-endpoint/save_verification.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ school, gender, secret })
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert("Verification saved!");
          closeVerifyModal();
        } else {
          alert("Failed to save verification!");
        }
      });
  }
  
  function updateVerification() {
    // Switch to step 1 for updating
    document.getElementById("step1").style.display = "block";
    document.getElementById("step2").style.display = "none";
    document.getElementById("info").style.display = "none";
  }
  
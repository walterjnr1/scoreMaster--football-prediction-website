<?php
include('inc/email.php'); 
include('config.php'); 

session_start();
$error = '';
$success = '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$password = $_SESSION['password'];

if (isset($_POST['btnverify'])) {
  // Collect OTP from hidden input
  $otp = isset($_POST['otp']) ? $_POST['otp'] : '';

  // Check if OTP exists for this email
  $stmt = $conn->prepare("SELECT *, TIMESTAMPDIFF(MINUTE, created_at, NOW()) AS minutes_diff FROM otps WHERE email = ? AND code = ?");
  $stmt->bind_param("ss", $email, $otp);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $otp_row = $result->fetch_assoc();
    if ($otp_row['minutes_diff'] < 15) {
      // OTP is valid and not expired
      // Fetch user details for email
      $user_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
      $user_stmt->bind_param("s", $email);
      $user_stmt->execute();
      $user_result = $user_stmt->get_result();
      $user = $user_result->fetch_assoc();

      $fullname = isset($user['fullname']) ? $user['fullname'] : '';

      // delete otp from otps table
      $delete_otp_query = $conn->prepare("DELETE FROM otps WHERE email = ?");
      $delete_otp_query->bind_param("s", $email);
      $delete_otp_query->execute();

      // update status in users table
      $sql_user = "UPDATE users SET status=? WHERE email=?";
      $stmt2 = $conn->prepare($sql_user);
      $status = '1';
      $stmt2->bind_param("ss", $status, $email);
      $stmt2->execute();

      // send email notification
      $message = "
      <html>
      <head>
      <title>Welcome to $app_name!</title>
      </head>
      <body>
      <p>Hi <strong>$fullname</strong>,</p>
      <p>Congratulations! Your registration to <strong>$app_name</strong> was successful.</p>
      <p>You can now log in and start making money from our predictions.</p>
      <p><strong>Your Details:</strong></p>
      <ul>
        <li>Name: <strong>$fullname</strong></li>
        <li>Email: <strong>$email</strong></li>
        <li>Password: <strong>$password</strong></li>
      </ul>
      <p>If you have any questions, feel free to contact our support team.</p>
      <p>Good luck and enjoy predicting!</p>
      <br>
      <p>Best regards,<br>
      The $app_name Team</p>
      </body>
      </html>";

      $subject = "Complete Registration | $app_name";
      if (sendEmail($email, $subject, $message)) {
        header("Location: success");
      } else {
        $_SESSION['error'] = 'Registration succeeded but email notification failed.';
      }
    } else {
      // OTP expired
      $error = "OTP code has expired. Please request a new code.";
    }
  } else {
    // OTP not found or invalid
    $error = "Invalid OTP code. Please check and try again.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('partials/head.php'); ?>
  <title>ScoreMaster: OTP Verification</title>
</head>

<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
   <div class="container">
  <a class="navbar-brand d-flex align-items-center" href="#">
    <img
     src="uploadImage/logo.png"
     alt="ScoreMaster Logo"
     width="92"
     height="53"
     class="navbar-logo"
    />
    ScoreMaster
  </a>
  <button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarNav"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  </div>
   </div>
  </nav>

  <!-- OTP Verification Form -->
  <div class="container">
   <div class="otp-header">
  <h1>OTP Verification</h1>
  <p class="">Enter the 5-digit code sent to <?php echo $email; ?> to verify your account.</p>
   </div>
   <div class="otp-card">
  
   <?php if ($error): ?>
  <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>
  <form method="post" action="" id="otpForm" autocomplete="off">
    <label class="form-label" for="otp1">OTP Code</label>
    <div class="otp-input-group">
    <input type="text" class="otp-box" name="otp[]"  maxlength="1" pattern="\d" inputmode="numeric" required autocomplete="one-time-code">
    <input type="text" class="otp-box" name="otp[]"  maxlength="1" pattern="\d" inputmode="numeric" required>
    <input type="text" class="otp-box" name="otp[]"  maxlength="1" pattern="\d" inputmode="numeric" required>
    <input type="text" class="otp-box" name="otp[]"  maxlength="1" pattern="\d" inputmode="numeric" required>
    <input type="text" class="otp-box" name="otp[]"  maxlength="1" pattern="\d" inputmode="numeric" required>
    </div>
    <input type="hidden" name="otp" id="otp-hidden">
    <button type="submit" name= "btnverify" class="btn-verify">Verify OTP</button>
  </form>
  <div class="otp-links mt-3">
    Didn't receive the code? <a href="resend_otp.php?email=<?php echo urlencode($email); ?>">Resend OTP</a>
  </div>
   </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
  <div class="container">
    <div class="mb-2">&copy; 2024 ScoreMaster. All rights reserved.</div>
   </div>  
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // Auto-focus and move to next box
  const inputs = document.querySelectorAll('.otp-box');
  inputs.forEach((input, idx) => {
  input.addEventListener('input', function() {
  if (this.value.length === 1 && idx < inputs.length - 1) {
    inputs[idx + 1].focus();
  }
  });
  input.addEventListener('keydown', function(e) {
  if (e.key === 'Backspace' && this.value === '' && idx > 0) {
    inputs[idx - 1].focus();
  }
  });
  });

  // On form submit, combine values into hidden input
  document.getElementById('otpForm').addEventListener('submit', function(e) {
  let otp = '';
  inputs.forEach(input => {
  otp += input.value;
  });
  document.getElementById('otp-hidden').value = otp;
  // Optionally, prevent submit if not 5 digits
  if (!/^\d{5}$/.test(otp)) {
  e.preventDefault();
  alert('Please enter a valid 5-digit OTP code.');
  }
  });
  </script>
</body>
</html>

<?php
include('config.php');
include('inc/email.php'); 

$error = '';
$success = '';

if (isset($_POST['btnreset'])) {
  $email = trim($_POST['txtemail']);

  // Check if email exists
  $stmt = $conn->prepare("SELECT id, fullname FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $fullname);
    $stmt->fetch();

    // Generate random 5-character alphanumeric password
    $new_password_plain = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);
    $new_password_hash = password_hash($new_password_plain, PASSWORD_DEFAULT);

    // Update password in database
    $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $update_stmt->bind_param("si", $new_password_hash, $user_id);
    if ($update_stmt->execute()) {
      // Send email with new password
      $subject = "Password Reset Notification | $app_name";
      $message = "
      <html>
      <head>
        <title>Password Reset</title>
      </head>
      <body>
        <p>Hello <strong>" . htmlspecialchars($fullname) . "</strong>,</p>
        <p>Your new password is: <strong>" . htmlspecialchars($new_password_plain) . "</strong></p>
        <p>Please log in and change your password immediately.</p>
        <p>Regards,<br><strong>$app_name</strong> Team</p>
      </body>
      </html>";

      if (sendEmail($email, $subject, $message)) {
        $success = "A new password has been sent to your Email.";
      } else {
        $error = "Failed to send email. Please try again later.";
      }
    } else {
      $error = "Failed to update password. Please try again.";
    }
    $update_stmt->close();
  } else {
    $error = "No account found with that email address.";
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('partials/head.php') ;?>
       <title>ScoreMaster: Sport Predictions, Tips &amp; Soccer News | Forgot Password</title>
       
</head>
    
  
<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index">
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
                     <?php //include('partials/navbar.php'); ?>

      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="container">
    <div class="login-header">
      <h1>Forgot Password</h1>
      <p class="">Enter your registered email address below and we'll send you a new password if your account is found.</p>
    </div>

    <div class="login-card">
      <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php elseif ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
      <?php endif; ?>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="loginEmail" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="loginEmail" name="txtemail" placeholder="Enter your email address" required value="<?php echo isset($_POST['txtemail']) ? htmlspecialchars($_POST['txtemail']) : ''; ?>">
        </div>
        <button type="submit" name="btnreset" class="btn-login w-100">Reset</button>
      </form>
      <div class="mt-3 text-center">
        <a href="login.php">Back to Login</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

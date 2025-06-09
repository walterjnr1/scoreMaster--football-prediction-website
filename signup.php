<?php
include('inc/email.php'); 
include('config.php'); 

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get and sanitize form inputs
  $fullname = trim($_POST['fullname']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate inputs
  if (empty($fullname) || empty($email) || empty($phone) || empty($password) || empty($confirm_password) ) {
    $error = "All fields are required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address.";
  } elseif ($password !== $confirm_password) {
    $error = "Passwords do not match.";
  } else {
    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $error = "Email already exists.";
    } else {
      // Hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Insert user
      $role = 'user';
      $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $fullname, $email, $phone, $hashed_password, $role);
      if ($stmt->execute()) {
        // Generate OTP
        $otp_code = rand(10000, 99999);

        // Insert OTP
        $stmt_otp = $conn->prepare("INSERT INTO otps (email, code) VALUES (?, ?)");
        $stmt_otp->bind_param("si", $email, $otp_code);
        $stmt_otp->execute();

        // Send OTP Email
        $subject = "OTP Verification | $app_name";
        $message = "
        <html>
        <head>
          <title>OTP Verification</title>
        </head>
        <body>
          <p>Hello <strong>$fullname</strong>,</p>
          <p>Your OTP code is: <strong>$otp_code</strong></p>
          <p>Please enter this code to verify your account.</p>
          <p>N/B: Code expires after 15 minutes.</p>

          <p>Regards</p>

          <p><strong>$app_name</strong> Team</p>
        </body>
        </html>";

        sendEmail($email, $subject, $message);

        // Redirect to OTP page
        $_SESSION['password'] = $password;
        header("Location: otp?email=" . urlencode($email));
      } else {
        $error = "Registration failed. Please try again.";
      }
    }
    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('partials/head.php') ;?>
   <title>ScoreMaster: Sport Predictions, Tips &amp; Soccer News | Sign up</title>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="uploadImage/logo.png" alt="ScoreMaster Logo" width="92" height="53" class="navbar-logo" />
    ScoreMaster
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <?php include('partials/navbar.php'); ?>
    </div>
  </div>
  </nav>

  <!-- Signup Form -->
  <div class="container">
  <div class="login-header">
    <h1>Sign Up for ScoreMaster</h1>
    <p class="text-muted">Create your account and start enjoying premium predictions.</p>
  </div>
  <div class="login-card">
    <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" autocomplete="off">
    <div class="mb-3">
      <label for="signupName" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="signupName" name="fullname" placeholder="Enter your full name" required value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="signupEmail" class="form-label">Email address</label>
      <input type="email" class="form-control" id="signupEmail" name="email" placeholder="Enter your email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="signupPhone" class="form-label">Phone</label>
      <input type="text" class="form-control" id="signupPhone" name="phone" placeholder="Enter your phone number" required value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="signupPassword" class="form-label">Password</label>
      <input type="password" class="form-control" id="signupPassword" name="password" placeholder="Create a password" required>
    </div>
    <div class="mb-3">
      <label for="signupConfirmPassword" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="signupConfirmPassword" name="confirm_password" placeholder="Confirm your password" required>
    </div>
   
    <button type="submit" class="btn-login">Sign Up</button>
    </form>
    <div class="login-links mt-3">
    Already have an account? <a href="login.html">Login</a>
    </div>
  </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
  <?php include('partials/footer.php'); ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include('config.php');

$error = '';
$success = '';

if (isset($_POST['btnlogin'])) {
  $email = $conn->real_escape_string($_POST['txtemail']);
  $password = $conn->real_escape_string($_POST['txtpassword']);

  $query = "SELECT * FROM users WHERE email = '$email' AND status = '1' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($user = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['fullname'] = $user['fullname'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['logged'] = time();

      if ($user['role'] === 'admin') {
        header("Location: Admin/index");
      } else {
        header("Location: index");
      }
    } else {
      $error = "Invalid password!";
    }
  } else {
    $error = "No User found with this Email or account is inactive.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('partials/head.php') ;?>
       <title>ScoreMaster: Sport Predictions, Tips &amp; Soccer News | Login</title>
       
</head>
    
  
<body>

  <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg">
           <?php include('partials/navbar.php'); ?>
     </nav>

  <!-- Login Form -->
  <div class="container">
    <div class="login-header">
      <h1>Login to ScoreMaster</h1>
      <p class="">Access your account and enjoy premium predictions.</p>
    </div>

      
    <div class="login-card">
      <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
         <form  action="" method="POST" >
        <div class="mb-3">
          <label for="loginEmail" class="form-label">Email address</label>
          <input type="email" class="form-control" name="txtemail" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="loginPassword" class="form-label">Password</label>
          <input type="password" class="form-control" name="txtpassword" placeholder="Enter your password" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="rememberMe">
          <label class="form-check-label" for="rememberMe" style="color:#aaa;">Remember me</label>
        </div>
        <button type="submit" name="btnlogin" class="btn-login">Login</button>
      </form>
      <div class="login-links mt-3">
        <a href="forgot-password">Forgot password?</a> <br>
        Don't have an account? <a href="signup">Sign Up</a>
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

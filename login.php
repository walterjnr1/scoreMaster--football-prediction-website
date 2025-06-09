<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('partials/head.php') ;?>
       <title>ScoreMaster: Sport Predictions, Tips &amp; Soccer News | Login</title>
       
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
                     <?php include('partials/navbar.php'); ?>

      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="container">
    <div class="login-header">
      <h1>Login to ScoreMaster</h1>
      <p class="text-muted">Access your account and enjoy premium predictions.</p>
    </div>
    <div class="login-card">
      <form>
        <div class="mb-3">
          <label for="loginEmail" class="form-label">Email address</label>
          <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="loginPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="rememberMe">
          <label class="form-check-label" for="rememberMe" style="color:#aaa;">Remember me</label>
        </div>
        <button type="submit" class="btn-login">Login</button>
      </form>
      <div class="login-links mt-3">
        <a href="forgot-password.html">Forgot password?</a> <br>
        Don't have an account? <a href="signup.html">Sign Up</a>
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

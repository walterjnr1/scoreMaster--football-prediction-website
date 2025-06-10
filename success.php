<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partials/head.php'); ?>
    <title>ScoreMaster: Sign Up Success</title>
</head>
<style>
  body {
     background-color: #121212;
     color: #ffffff;
  }
  .navbar {
     background-color: #1e1e1e;
  }
  .nav-link,
  .navbar-brand {
     color: #fff;
  }
  .nav-link:hover {
     color: #ffa500;
  }
  .success-header {
     text-align: center;
     padding: 60px 20px 30px 20px;
  }
  .success-header h1 {
     color: #ffa500;
     margin-bottom: 10px;
  }
  .success-card {
     background-color: #1e1e1e;
     border: 2px solid #333;
     border-radius: 12px;
     padding: 40px 30px 30px 30px;
     max-width: 600px;
     margin: 0 auto 30px auto;
     box-shadow: 0 4px 24px rgba(0,0,0,0.2);
     text-align: center;
  }
  .success-icon {
     font-size: 4em;
     color: #ffa500;
     margin-bottom: 20px;
  }
  .btn-login {
     background-color: #ffa500;
     border: none;
     color: #000;
     font-weight: bold;
     padding: 10px 20px;
     border-radius: 6px;
     width: 100%;
     margin-top: 24px;
     font-size: 1.1em;
     text-decoration: none;
     display: inline-block;
  }
  .btn-login:hover {
     background-color: #ff8800;
     color: #000;
     text-decoration: none;
  }
  .footer {
     background-color: #1e1e1e;
     color: #aaa;
     padding: 30px 0 10px 0;
     text-align: center;
     margin-top: 40px;
  }
  .footer a {
     color: #ffa500;
     text-decoration: none;
  }
  .footer a:hover {
     text-decoration: underline;
  }
</style>
<body>

  <!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
           <?php include('partials/navbar.php'); ?>
     </nav>

  <!-- Success Message -->
  <div class="container">
     <div class="success-header">
        <h1>Sign Up Successful!</h1>
        <p class="">Your account has been created successfully.</p>
     </div>
     <div class="success-card">
        <div class="success-icon">
          &#10004;
        </div>
        <h2>Welcome to ScoreMaster!</h2>
        <p>
          Thank you for signing up.<br>
          You can now log in and start using your account.
        </p>
        <a href="login.php" class="btn-login">Go to Login</a>
     </div>
  </div>

  <!-- Footer -->
    <footer class="footer">
               <?php include('partials/footer.php'); ?>
  
    </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

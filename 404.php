<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>404 - Page Not Found | ScoreMaster</title>
  <link rel="icon" type="image/png" href="uploadImage/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
    .error-container {
      text-align: center;
      padding: 100px 20px 40px 20px;
    }
    .error-container h1 {
      font-size: 6rem;
      color: #ffa500;
      font-weight: bold;
    }
    .error-container h2 {
      font-size: 2rem;
      margin-bottom: 20px;
    }
    .error-container p {
      color: #ccc;
      font-size: 1.1rem;
      margin-bottom: 30px;
    }
    .btn-back {
      background-color: #ffa500;
      color: #000;
      padding: 10px 25px;
      font-weight: bold;
      border-radius: 6px;
      text-decoration: none;
    }
    .btn-back:hover {
      background-color: #ff8800;
    }
    .footer {
      background-color: #1e1e1e;
      color: #aaa;
      padding: 30px 0 10px 0;
      text-align: center;
      margin-top: 60px;
    }
    .footer a {
      color: #ffa500;
      text-decoration: none;
    }
    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

   <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
           <?php include('partials/navbar.php'); ?>
     </nav>

  <!-- 404 Error Content -->
  <div class="container error-container">
    <h1>404</h1>
    <h2>Oops! Page Not Found</h2>
    <p>We couldn’t find the page you were looking for. It might have been moved or deleted.</p>
    <a href="index" class="btn-back">Go Back Home</a>
  </div>

  <!-- Footer -->
  <footer class="footer">
       <?php include('partials/footer.php'); ?>
    </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

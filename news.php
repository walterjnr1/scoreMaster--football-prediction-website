<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('partials/head.php') ;?>
       <title>ScoreMaster: Sport Predictions, Tips &amp; Soccer News | News</title>

</head>
  
  <style>
    body {
      background-color: #121212;
      color: #ffffff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .navbar {
      background-color: #1e1e1e;
    }
    .nav-link, .navbar-brand {
      color: #fff;
    }
    .nav-link:hover {
      color: #ffa500;
    }
    .news-container {
      padding: 40px 20px;
    }
    .news-card {
      background-color: #1e1e1e;
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 30px;
      box-shadow: 0 0 10px rgba(255, 165, 0, 0.1);
    }
    .news-card img {
      width: 100%;
      height: auto;
    }
    .news-content {
      padding: 20px;
    }
    .news-content h4 {
      color: #ffa500;
      margin-bottom: 10px;
    }
    .news-content p {
      color: #ccc;
    }
  </style>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.html">ScoreMaster</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon text-white"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
              <?php include('partials/navbar.php'); ?>
      </div>
    </div>
  </nav>

  <!-- News Section -->
  <div class="container news-container">
    <h2 class="mb-4">Latest Football News</h2>

    <div class="news-card">
      <img src="https://via.placeholder.com/900x400?text=Champions+League+Final" alt="Champions League">
      <div class="news-content">
        <h4>Champions League Final Showdown</h4>
        <p>Real Madrid and Manchester City are set to battle for European glory. Who will come out on top? Our experts weigh in.</p>
      </div>
    </div>
  </div>

   <footer class="footer">
       <?php include('partials/footer.php'); ?>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

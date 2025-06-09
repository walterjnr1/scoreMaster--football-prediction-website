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
                <ul class="navbar-nav ms-auto align-items-lg-center flex-wrap">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#predictions">Predictions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fixtures">Upcoming Matches</a></li>
                    <li class="nav-item"><a class="nav-link" href="#blog">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" id="contactUsLink">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="pricing.html">Pricing Plan</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.html">Sign Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="faq.html">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="tips.html">Expert Tips</a></li>
                    <li class="nav-item"><a class="nav-link" href="results.html">Results</a></li>
                    <li class="nav-item"><a class="nav-link" href="partners.html">Partners</a></li>
                    <li class="nav-item"><a class="nav-link" href="why-premium.html">Why Premium?</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://wa.me/08067361023" target="_blank">WhatsApp</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://t.me/yourtelegramgroup" target="_blank">Join Telegram</a></li>
                    <!-- Dropdown for More -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="moreDropdown">
                            <li><a class="dropdown-item" href="#">Today's 1.5 Predictions</a></li>
                            <li><a class="dropdown-item" href="#">Today's 2.5 Predictions</a></li>
                            <li><a class="dropdown-item" href="#">Today's BTS/BTTS Predictions</a></li>
                            <li><a class="dropdown-item" href="#">Today's Draw Predictions</a></li>
                            <li><a class="dropdown-item" href="#">Tomorrow's Football Predictions</a></li>
                            <li><a class="dropdown-item" href="#">Yesterday's Football Predictions</a></li>
                            <li><a class="dropdown-item" href="contact.html">Support</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <!-- 404 Error Content -->
  <div class="container error-container">
    <h1>404</h1>
    <h2>Oops! Page Not Found</h2>
    <p>We couldn’t find the page you were looking for. It might have been moved or deleted.</p>
    <a href="index.php" class="btn-back">Go Back Home</a>
  </div>

  <!-- Footer -->
  <footer class="footer">
       <?php include('partials/footer.php'); ?>
    </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

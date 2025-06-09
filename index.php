<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('partials/head.php') ;?>
       <title>ScoreMaster: Sport Predictions, Tips &amp; Soccer News | Bet Smarter</title>

</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="uploadImage/logo.png" alt="ScoreMaster Logo" width="92"
                    height="53" class="navbar-logo" /> ScoreMaster </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"           >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <?php include('partials/navbar.php'); ?>
            </div>
        </div>
    </nav>

    <!-- Contact Us Modal -->
    <div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="contactUsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form>
            <div class="modal-header">
              <h5 class="modal-title" id="contactUsModalLabel">Contact Us</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="contactName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="contactName" required>
                </div>
                <div class="mb-3">
                  <label for="contactEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="contactEmail" required>
                </div>
                <div class="mb-3">
                  <label for="contactMessage" class="form-label">Message</label>
                  <textarea class="form-control" id="contactMessage" rows="4" required></textarea>
                </div>
                <div id="contactSuccess" class="text-success" style="display:none;">Thank you for contacting us!</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-accent">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Image Slider of Footballers -->
    <div class="footballer-slider mt-4">
        <?php include('partials/slider.php') ;?>
    </div>

    <!-- Hero Section -->
    <section class="hero">
     <?php include('partials/hero.php') ;?>
    </section>

    <!-- Football Predictions -->
    <section class="container my-5" id="predictions">
        <h2>Today's Football Predictions</h2>
            <?php include('partials/prediction.php') ;?>
    </section>

    <!-- Upcoming Matches -->
    <section class="container" id="fixtures">
        <h2>&nbsp;</h2>
        <h2>&nbsp;</h2>
        <h2>Upcoming Matches</h2>
        <div class="section-card">
            <div id="loadingMatches" class="loading">Loading upcoming matches...</div>
            <table
                class="table table-striped table-dark"
                id="upcomingMatchesTable"
                style="display:none;"
            >
                <thead>
                    <tr>
                        <th>Match</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Competition</th>
                    </tr>
                </thead>
                <tbody id="matchesBody"></tbody>
            </table>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="container my-5" id="blog">
        <h2>Soccer News & Insights</h2>
     <?php include('partials/news.php') ;?>

    </section>

    <!-- Subscription Section -->
    <section class="container my-5 subscribe">
        <h2>Subscribe for Daily Predictions</h2>
        <p>Get premium predictions straight to your inbox. Subscribe now for just $5/month.</p>
        <form class="row g-3">
            <div class="col-md-8">
                <input
                    type="email"
                    class="form-control"
                />
            </div>
            <div class="col-md-4">
                <button class="btn btn-accent w-100">Subscribe &amp; Pay</button>
            </div>
        </form>
    </section>

    <!-- Call to Action -->
    <section class="container text-center cta">
        <h2>Start Predicting &amp; Winning Today!</h2>
        <p>Join thousands of football fans making expert predictions.</p>
        <a href="signup" class="btn btn-accent btn-lg">Create Account</a>
    </section>
    <!-- Footer -->
    <footer class="footer">
       <?php include('partials/footer.php'); ?>
    </footer>

    
</body>
</html>

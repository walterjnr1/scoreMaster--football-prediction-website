       <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index">
                <img src="uploadImage/logo.png" alt="ScoreMaster Logo" width="92"
                    height="53" class="navbar-logo" /> ScoreMaster </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"           >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav ms-auto align-items-lg-center flex-wrap">
                    <li class="nav-item"><a class="nav-link" href="index">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#predictions">Predictions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fixtures">Upcoming Matches</a></li>
                    <li class="nav-item"><a class="nav-link" href="#blog">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" id="contactUsLink">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="pricing">Pricing Plan</a></li>
                    <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup">Sign Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="results">Results</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://wa.me/08067361023" target="_blank">WhatsApp</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://t.me/yourtelegramgroup" target="_blank">Join Telegram</a></li>
                    <?php
                    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                      echo '<li class="nav-item"><span class="navbar-item">(Welcome ' . htmlspecialchars($row_user['fullname']) . ')</span></li>';
                    ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="moreDropdown">
                        <li><a class="dropdown-item" href="change-password">Change Password</a></li>
                        <li><a class="dropdown-item" href="faq">Profile</a></li>
                      </ul>
                    </li>
                    <?php
                    } else {
                      echo '<li class="nav-item"><span class="navbar-item">(Welcome Anonymous)</span></li>';
                    }
                    ?>
                    </ul>
                  </div>
                  <!-- Ensure Bootstrap JS is loaded -->
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </div>
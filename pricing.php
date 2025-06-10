<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('partials/head.php') ;?>
       <title>ScoreMaster: Sport Predictions, Tips &amp; Soccer News | Pricing Plan</title>
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
        .pricing-header {
            text-align: center;
            padding: 60px 20px;
        }
        .pricing-header h1 {
            color: #ffa500;
            margin-bottom: 10px;
        }
        .pricing-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .pricing-card:hover {
            transform: translateY(-5px);
            border-color: #ffa500;
        }
        .plan-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #ffa500;
        }
        .plan-price {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .plan-description {
            font-size: 0.95rem;
            color: #aaa;
            margin-bottom: 20px;
        }
        .plan-features {
            text-align: left;
            margin-bottom: 20px;
            padding-left: 0;
            list-style-type: none;
        }
        .plan-features li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }
        .plan-features .icon-yes {
            color: #28a745;
            font-weight: bold;
            font-size: 1.2em;
            min-width: 22px;
        }
        .plan-features .icon-no {
            color: #dc3545;
            font-weight: bold;
            font-size: 1.2em;
            min-width: 22px;
        }
        .btn-subscribe {
            background-color: #ffa500;
            border: none;
            color: #000;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 6px;
            margin-top: auto;
        }
        .btn-subscribe:hover {
            background-color: #ff8800;
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
        .category-list {
            margin: 0 0 0 30px;
            padding: 0;
            color: #aaa;
            font-size: 0.97em;
            list-style-type: none;
        }
        .category-list li {
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .category-list .icon-yes {
            color: #28a745;
            font-weight: bold;
            font-size: 1.1em;
            min-width: 20px;
        }
        /* Make all pricing cards the same height */
        .row-eq-height {
            display: flex;
            flex-wrap: wrap;
        }
        @media (min-width: 768px) {
            .row-eq-height > [class^='col-'] {
                display: flex;
            }
        }
        .pricing-card .features-wrapper {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
    </style>

<body>

    <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg">
           <?php include('partials/navbar.php'); ?>
     </nav>

    <!-- Pricing Plans -->
    <div class="container">
        <div class="pricing-header">
            <h1>Choose Your Plan</h1>
            <p class="text-muted">Affordable and flexible pricing for every football fan.</p>
        </div>
        <div class="row row-eq-height justify-content-center">
            <!-- Free Plan -->
            <div class="col-md-4 d-flex">
                <div class="pricing-card w-100 d-flex flex-column">
                    <div class="plan-title">Free</div>
                    <div class="plan-price">₦0 / month</div>
                    <p class="plan-description">Get started with the basics.</p>
                    <div class="features-wrapper">
                        <ul class="plan-features">
                            <li><span class="icon-yes">&#10003;</span> Limited Match Predictions</li>
                            <li><span class="icon-yes">&#10003;</span> Access to Blog</li>
                            <li><span class="icon-no">&#10005;</span> Premium Booking Codes</li>
                            <li><span class="icon-no">&#10005;</span> Telegram Access</li>
                            <li><span class="icon-no">&#10005;</span> MidWeek/Weekend Banker</li>
                            <li><span class="icon-no">&#10005;</span> Daily 3 ODDS (SMS &amp; EMAIL)</li>
                            <li><span class="icon-no">&#10005;</span> Access to "6" Categories</li>
                      
                            <li><span class="icon-yes">&#10003;</span> Double Chance</li>
                            <li><span class="icon-yes">&#10003;</span> 1.5 Goals</li>
                        </ul>
                    </div>
                    <button class="btn-subscribe mt-3">Get Started</button>
                </div>
            </div>
            <!-- Standard Plan -->
            <div class="col-md-4 d-flex">
                <div class="pricing-card w-100 d-flex flex-column">
                    <div class="plan-title">Standard</div>
                    <div class="plan-price">₦3,500 / month</div>
                    <p class="plan-description">Perfect for regular bettors.</p>
                    <div class="features-wrapper">
                        <ul class="plan-features">
                            <li><span class="icon-yes">&#10003;</span> Full Match Predictions</li>
                            <li><span class="icon-yes">&#10003;</span> Daily Booking Codes</li>
                            <li><span class="icon-yes">&#10003;</span> Telegram Access</li>
                            <li><span class="icon-no">&#10005;</span> 1-on-1 Support</li>
                            <li><span class="icon-yes">&#10003;</span> MidWeek/Weekend Banker</li>
                            <li><span class="icon-no">&#10005;</span> Daily 3 ODDS (SMS &amp; EMAIL)</li>
                            <li><span class="icon-yes">&#10003;</span> Access to "6" Categories</li>
          
                            <li><span class="icon-yes">&#10003;</span> Double Chance</li>
                            <li><span class="icon-yes">&#10003;</span> 1.5 Goals</li>
                            <li><span class="icon-yes">&#10003;</span> DRAWS</li>
                        </ul>
                    </div>
                    <button class="btn-subscribe mt-3">Subscribe Now</button>
                </div>
            </div>
            <!-- Premium Plan -->
            <div class="col-md-4 d-flex">
                <div class="pricing-card w-100 d-flex flex-column">
                    <div class="plan-title">Premium</div>
                    <div class="plan-price">₦5,500 / month</div>
                    <p class="plan-description">Maximum value and support.</p>
                    <div class="features-wrapper">
                        <ul class="plan-features">
                            <li><span class="icon-yes">&#10003;</span> All Standard Features</li>
                            <li><span class="icon-yes">&#10003;</span> 1-on-1 Expert Support</li>
                            <li><span class="icon-yes">&#10003;</span> Early Booking Access</li>
                            <li><span class="icon-yes">&#10003;</span> Priority Email Support</li>
                            <li><span class="icon-yes">&#10003;</span> MidWeek/Weekend Banker</li>
                            <li><span class="icon-yes">&#10003;</span> Daily 3 ODDS (SMS &amp; EMAIL)</li>
                            <li><span class="icon-yes">&#10003;</span> Access to "6" Categories</li>
                        
                            <li><span class="icon-yes">&#10003;</span> Double Chance</li>
                            <li><span class="icon-yes">&#10003;</span> 1.5 Goals</li>
                            <li><span class="icon-yes">&#10003;</span> DRAWS</li>
                            <li><span class="icon-yes">&#10003;</span> 2.5 Goals</li>
                            <li><span class="icon-yes">&#10003;</span> BTTS</li>
                            <li><span class="icon-yes">&#10003;</span> SINGLES</li>
                            <li><span class="icon-yes">&#10003;</span> 1st Half Goals</li>
                            <li><span class="icon-yes">&#10003;</span> Multi-Goals</li>
                            <li><span class="icon-yes">&#10003;</span> Win Either Half</li>
                            <li><span class="icon-yes">&#10003;</span> HT/FT</li>
                            <li><span class="icon-yes">&#10003;</span> Combo</li>
                            <li><span class="icon-yes">&#10003;</span> Most Scoring Half</li>
                            <li><span class="icon-yes">&#10003;</span> Corners</li>
                            <li><span class="icon-yes">&#10003;</span> Cards</li>
                            <li><span class="icon-yes">&#10003;</span> Fouls</li>
                            <li><span class="icon-yes">&#10003;</span> Offsides</li>
                        </ul>
                    </div>
                    <button class="btn-subscribe mt-3">Subscribe Now</button>
                </div>
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

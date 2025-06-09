<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
    header("Location: ../Auth/user_login");
}

// Fetch scratch cards
$data = $dbh->query("SELECT * FROM scratch_cards WHERE school_id='$school_id' AND is_used=0 ORDER BY id DESC")->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Print Scratch Cards</title>
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <?php include('partials/head.php') ;?>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f7f7f7;
            padding: 20px;
        }
        .print-btn {
            margin-bottom: 20px;
            text-align: center;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .scratch-card {
            background: white;
            border: 2px dashed #333;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            font-size: 18px;
        }
        .scratch-card h4 {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        .scratch-card p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }
        @media print {
            .print-btn {
                display: none;
            }
            body {
                background: white;
                padding: 0;
            }
        }
    </style>
</head>
<body>

<div class="print-btn">
    <button onclick="window.print();" class="btn btn-primary">
        <i class="fa fa-print"></i> Print Now
    </button>
</div>

<div class="card-grid">
    <?php 
    foreach ($data as $card) {
        echo '<div class="scratch-card">';
        echo '<h4>PIN</h4><p>' . htmlspecialchars($card['pin']) . '</p>';
        echo '<h4>Serial No.</h4><p>' . htmlspecialchars($card['serial_number']) . '</p>';
        echo '</div>';
    }
    ?>
</div>

</body>
</html>

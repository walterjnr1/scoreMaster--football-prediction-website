<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
  exit;
}

// Handle Scratch Card Generation
if (isset($_POST['btngenerate'])) {
  // Sanitize input
  $number_of_cards = intval($_POST['number_of_cards']);

  if ($number_of_cards <= 0) {
    $_SESSION['error'] = "Invalid number of cards!";
  } else {
    for ($i = 0; $i < $number_of_cards; $i++) {
      $pin = generatePin();
      $serial = generateSerial();

      // Save card into database
      $query = "INSERT INTO scratch_cards (school_id, pin, serial_number) VALUES (?, ?, ?)";
      $stmt = $dbh->prepare($query);
      $stmt->execute([$school_id, $pin, $serial]);
    }

    // Log activity
    $operation = "Generated $number_of_cards Scratch Cards on $current_date";
    log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

    $_SESSION['success'] = "$number_of_cards scratch cards generated successfully!";
  }
}

// Functions to generate random Pin and Serial
function generatePin($length = 12) {
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $pin = '';
  for ($i = 0; $i < $length; $i++) {
    $pin .= $characters[random_int(0, strlen($characters) - 1)];
  }
  return $pin;
}

function generateSerial($length = 12) {
  $characters = '0123456789';
  $serial = '';
  for ($i = 0; $i < $length; $i++) {
    $serial .= $characters[random_int(0, strlen($characters) - 1)];
  }
  return $serial;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Scratch Card Generator</title>
  <?php include('partials/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include('partials/navbar.php'); ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include('partials/sidebar.php'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>Scratch Card Generator</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Generate Scratch Cards</h3>
          </div>

          <form action="" method="POST">
            <div class="card-body">
            

              <div class="form-group">
                <label>Number of Cards to Generate</label>
                <input type="number" name="number_of_cards" class="form-control" placeholder="Enter number e.g. 100" required min="1">
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" name="btngenerate" class="btn btn-primary">Generate Cards</button>
            </div>
          </form>

        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <?php include('partials/footer.php'); ?>
  </footer>

</div>

<?php include('partials/bottom-script.php'); ?>
</body>
</html>

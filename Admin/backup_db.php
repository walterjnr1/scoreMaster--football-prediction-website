<?php 
include('../inc/email.php'); 
include('../inc/config.php'); 

if (empty($_SESSION['user_id'])) {
    header("Location: ../Auth/user_login");
    exit();
}

// Get school email securely from DB if not already
$schoolEmail = $row_school['email']; // fallback

if (isset($_POST["btnbackup"])) {
    // Database credentials
    $dbHost = DB_HOST;
    $dbUser = DB_USER;
    $dbPass = DB_PASS;
    $dbName = DB_NAME;

    // Set paths
    $backupDir = '../backups/';
    if (!file_exists($backupDir)) {
        mkdir($backupDir, 0777, true);
    }

    $timestamp = date("Y-m-d_H-i-s");
    $backupFile = $backupDir . $dbName . "_$timestamp.sql";

    // Path to mysqldump
    $mysqldump = 'C:\\xampp\\mysql\\bin\\mysqldump.exe'; // Update this path as needed

    // Secure password handling using double quotes
    $command = "\"$mysqldump\" --user=\"$dbUser\" --password=\"$dbPass\" --host=\"$dbHost\" $dbName > \"$backupFile\"";
    $output = shell_exec($command . " 2>&1");

    // Validate and email
    if (file_exists($backupFile) && filesize($backupFile) > 0) {
        $subject = "Database Backup - $dbName";
        $message = "
        <html>
        <head><title>Database Backup</title></head>
        <body>
        <p>Attached is the latest database backup for <strong>$dbName</strong> generated at <strong>$timestamp</strong>.</p>
        <p>Ensure you store this file securely.</p>
        </body>
        </html>";

        if (sendEmail($schoolEmail, $subject, $message, $backupFile)) {
          //activity log
              $operation = "Backup a database on $current_date";
              log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

            $_SESSION['success'] = "Backup successful and sent to school email.";
        } else {
            $_SESSION['error'] = "Backup created but email sending failed.";
        }
    } else {
        $_SESSION['error'] = "Database backup failed. Error: " . htmlspecialchars($output);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Backup Database</title>
  <?php include('partials/head.php') ;?>
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
        <h1>Backup Database</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
   

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Backup & Email</h3>
          </div>
          <form method="POST" action="">
            <div class="card-body">
              <p>This will backup your entire database and email the backup file to the school.</p>
            </div>
            <div class="card-footer">
              <button type="submit" name="btnbackup" class="btn btn-primary">Backup Now</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <?php include('partials/footer.php'); ?>
  </footer>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<?php include('partials/bottom-script.php'); ?>
</body>
</html>

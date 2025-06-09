<?php 
include('../inc/config.php');
include('../inc/email.php'); 

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}
$schoolEmail = $row_school['email'];
if (isset($_POST['btnadd'])) {
  // Sanitize inputs
  $year = mysqli_real_escape_string($conn, $_POST['txtyear']);
  $term = mysqli_real_escape_string($conn, $_POST['cmdterm']);
  $start = mysqli_real_escape_string($conn, $_POST['txtstart']);
  $end = mysqli_real_escape_string($conn, $_POST['txtend']);

  // Validate inputs
  $query = "SELECT * FROM academic_session WHERE school_id='$school_id' and session = '$year' and term='$term'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "Session already exists!";
  } else {
    $query = "INSERT INTO academic_session (school_id, session, term, start_date, end_date) VALUES ('$school_id', '$year', '$term', '$start', '$end')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      // Get the session_id of the newly inserted session
      $session_id = mysqli_insert_id($conn);

      // Update other records with status 1 to 0
      $update_query = "UPDATE academic_session SET status = 0 WHERE school_id='$school_id' and status = 1";
      $update_result = mysqli_query($conn, $update_query);

      if ($update_result) {
        // Update newly added record with status 1
        $update_new_query = "UPDATE academic_session SET status = 1 WHERE school_id='$school_id' and session = '$year' and term='$term'";
        $update_new_result = mysqli_query($conn, $update_new_query);

        // Update all students' current_session_id with the new session_id
        $update_students_query = "UPDATE students SET current_session_id = '$session_id' WHERE school_id = '$school_id'";
        mysqli_query($conn, $update_students_query);

        //backup the database
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

            sendEmail($schoolEmail, $subject, $message, $backupFile);

            if ($update_new_result) {
                //activity log
                $operation = "Created a session: $year and $term on $current_date";
                log_activity($conn, $school_id, $user_id, $role, $operation, $ip_address);

                $_SESSION['success'] = "Session created successfully. Database Backup sent to $schoolEmail.";
            } else {
                $_SESSION['error'] = "Database error: Could not update newly added record.";
            }
        } else {
            $_SESSION['error'] = "Database error: Could not backup database.";
        }
      } else {
        $_SESSION['error'] = "Database error: Could not update other records.";
      }
    } else {
      $_SESSION['error'] = "Database error: Could not create Session.";
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Add Academic Session</title>
  <?php include('partials/head.php') ;?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('partials/navbar.php') ;?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <?php include('partials/sidebar.php') ;?>
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Class</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Session</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Session</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
           <div class="card-body">
           <div class="row">
            <div class="col-md-6">
            <div class="form-group">
           <label for="exampleInputEmail1">Academic Year</label>
               <input type="text" name="txtyear" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtyear'] ?? ''; ?>" required>
            
            </div>
            <div class="form-group">
           <label for="exampleInputEmail1">Term</label>
           <select id="cmdterm" name="cmdterm" class="form-control" required>
                        <option value="">--- Select Term --- </option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        
                    </select>               
            
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
           <label for="exampleInputEmail1">Start date</label>
               <input type="date" name="txtstart" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtstart'] ?? ''; ?>" required>
                </div>
            
            <div class="form-group">
           <label for="exampleInputEmail1">End Date</label>
               <input type="date" name="txtend" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtend'] ?? ''; ?>" required>
                </div>
            
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" name="btnadd" class="btn btn-primary">Save</button>
    </div>
</form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>

         
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>  <?php include('partials/footer.php') ;?></strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('partials/bottom-script.php') ;?>

</body>
</html>

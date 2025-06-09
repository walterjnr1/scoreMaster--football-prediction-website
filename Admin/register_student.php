<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
include('../inc/config.php');
require '../vendor/autoload.php'; // For PhpSpreadsheet
include('../inc/email.php'); 

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
  //exit;
}

// Function to generate 5-digit random admission number
function generateAdmissionNo($conn, $school_id) {
  do {
    $admission_no = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    $check = mysqli_query($conn, "SELECT 1 FROM students WHERE school_id='$school_id' AND admission_no='$admission_no'");
  } while(mysqli_num_rows($check) > 0);
  return $admission_no;
}


if (isset($_POST['btnupload'])) {
  if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Remove header row
    array_shift($rows);

    $success_count = 0;
    $fail_count = 0;
    foreach ($rows as $row) {
      // Map columns
      list($fullname, $sex, $dob, $address, $region, $district, $parent_email, $parent_phone, $day_boarding, $previous_school) = $row;

      $admission_no = generateAdmissionNo($conn, $school_id);
      //generate a random 6 digits password
      $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Prepare and insert
      $sql = "INSERT INTO students (admission_no, school_id, fullname, password, sex, dob, address, region, district, parent_email, parent_phone, day_boarding, previous_school,status) VALUES (
        '$admission_no','$school_id','$fullname','$hashed_password','$sex','$dob','$address','$region','$district','$parent_email','$parent_phone','$day_boarding','$previous_school',1)";
      if (mysqli_query($conn, $sql)) {

// send welcome email
   $subject = "Welcome to $app_name - Student Registration";
  $message = "
    <html>
    <head>
    <title>Welcome to $app_name</title>
    </head>
    <body>
    <p>Dear Parent/Guardian,</p>
    <p>Your child <strong>$fullname</strong> has been registered successfully.</p>
    <p><strong>Admission No:</strong> $admission_no<br>
    <strong>Password:</strong> $password</p>
    <p>You can log in to the portal to view details and results.</p>
    <p>Regards,<br>$app_name Team</p>
    </body>
    </html>
  ";
  $email = $parent_email; // Ensure $email is set to parent's email
  sendEmail($email, $subject, $message);

      // Log activity
      $operation = "registered student on $current_date";
      log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);
      
        $success_count++;
      } else {
        $fail_count++;
      }
    }
    $_SESSION['success'] = "$success_count students registered successfully. $fail_count failed.";
  } else {
    $_SESSION['error'] = "Please upload a valid Excel file.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Register Students</title>
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
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1>Register Students (Excel Upload)</h1>
      </div>
    </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Upload Excel File</h3>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
      
          <div class="form-group">
          <label for="excel_file">Excel File (.xlsx, .xls)</label>
          <input type="file" name="excel_file" class="form-control" id="excel_file" accept=".xlsx,.xls" required>
          </div>
          <p><b>Excel columns:</b> fullname, password, sex, dob, address, region, district, parent email, parent phone, day/boarding, previous school, photo</p>
        </div>
        <div class="card-footer">
          <button type="submit" name="btnupload" class="btn btn-primary">Upload</button>
        </div>
        </form>
      </div>
      </div>
    </div>
    </div>
  </section>
  </div>
  <footer class="main-footer">
  <strong><?php include('partials/footer.php'); ?></strong>
  </footer>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<?php include('partials/bottom-script.php'); ?>
</body>
</html>

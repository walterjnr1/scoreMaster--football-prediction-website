<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
 
}

$student_id = intval($_GET['id']);
$stmt = $dbh->query("SELECT students.*, classes.*,classes.name AS class FROM students INNER JOIN classes ON students.class_id=classes.id WHERE students.id='$student_id' AND students.school_id='$school_id'");
$row_student = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Student Profile</title>
  <?php include('partials/head.php'); ?>
  <script>
    function printdiv(printpage) {
        var headstr = "<html><head><title>Student Data</title></head><body>";
        var footstr = "</body></html>";
        var newstr = document.getElementById(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr + newstr + footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }
  </script>
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
            <h1>Student Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Data</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-info" id="student_data">
          <div class="card-header">
            <h3 class="card-title">Complete Student Information</h3>
          </div>

          <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Student Name:</strong> <?php echo $row_student['fullname']; ?></li>
                  <li class="list-group-item"><strong>Admission ID:</strong> <?php echo $row_student['admission_no']; ?></li>
                  <li class="list-group-item"><strong>Class:</strong> <?php echo $row_student['class']. $row_student['section']; ?></li>
                  <li class="list-group-item"><strong>Sex:</strong> <?php echo $row_student['sex']; ?></li>
                  <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo $row_student['dob']; ?></li>
                  <li class="list-group-item"><strong>Boarding Status:</strong> <?php echo $row_student['day_boarding']; ?></li>
                  <li class="list-group-item"><strong>House Name:</strong> <?php echo $row_student['house']; ?></li>
                  <li class="list-group-item"><strong>Parent Email:</strong> <?php echo $row_student['parent_email']; ?></li>
                  <li class="list-group-item">
                    <strong>Result Status:</strong> 
                    <?php if ($row_student['result_status'] == 1): ?><span class="badge bg-success">Unlocked</span><?php else: ?><span class="badge bg-danger">Locked</span><?php endif; ?>
                  </li>
                </ul>
              </div>

              <div class="col-md-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Parent Phone:</strong> <?php echo $row_student['parent_phone']; ?></li>
                  <li class="list-group-item"><strong>Address:</strong> <?php echo $row_student['address']; ?></li>
                  <li class="list-group-item"><strong>District:</strong> <?php echo $row_student['district']; ?></li>
                  <li class="list-group-item"><strong>Region:</strong> <?php echo $row_student['region']; ?></li>
                  <li class="list-group-item">
                    <strong>Photo:</strong><br>
                    <img src="../<?php echo (!empty($row_student['photo'])) ? htmlspecialchars($row_student['photo']) : 'uploadImage/Profile/default.png'; ?>" width="100" height="100" style="object-fit:cover; border-radius:50%;" />
                  </li>
                  <li class="list-group-item"><strong>Previous School:</strong> <?php echo $row_student['previous_school']; ?></li>
                  <li class="list-group-item">
                    <strong>Status:</strong> 
                    <?php if ($row_student['status'] == 1): ?>
                      <span class="badge bg-success">Active</span>
                    <?php else: ?>
                      <span class="badge bg-danger">Inactive</span>
                    <?php endif; ?>
                  </li>
                </ul>
              </div>

            </div>
          </div>

          <div class="card-footer text-end">
            <button id="print" onClick="printdiv('student_data');" class="btn btn-primary">
              <i class="fa fa-print"></i> Print
            </button>
          </div>
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

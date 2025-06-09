<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

if (isset($_POST['assign_student_btn'])) {
  $student_id = $_POST['student_id'];
  $class_id = $_POST['class_id'];

  // Check if student is already assigned
  $sql_check = "SELECT * FROM class_students WHERE school_id = '$school_id' AND student_id = '$student_id'";
  $result_check = mysqli_query($conn, $sql_check);

  if (mysqli_num_rows($result_check) > 0) {
    $_SESSION['error'] = 'Student is already assigned to a class';
  } else {
    // Insert into class_students
    $insert_sql = "INSERT INTO class_students (school_id, student_id, class_id) VALUES ('$school_id', '$student_id', '$class_id')";
       
    // update class_id in students
    $update_sql = "UPDATE students SET class_id = '$class_id' WHERE id = '$student_id' and school_id='$school_id'";

    if (mysqli_query($conn, $insert_sql) && mysqli_query($conn, $update_sql)) {

      //activity log
      $operation = "Assigned student to a Class on $current_date";
     log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

      $_SESSION['success'] = 'Student assigned to class successfully';
    } else {
      $_SESSION['error'] = 'Failed to assign student to class';
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Assign Students to Class</title>
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
            <h1>Assign Students to Class</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Assign Students</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>Students Without Class</h5>
                <a href="student_record"><button type="submit" name="btnadd" class="btn btn-primary">Student record</button></a>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Admission No</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $students = $dbh->query("SELECT * FROM students WHERE school_id='$school_id' AND id NOT IN (SELECT student_id FROM class_students WHERE school_id='$school_id')")->fetchAll();
                    $cnt = 1;
                    foreach ($students as $student):
                    ?>
                    <tr>
                      <td><?php echo $cnt++; ?></td>
                      <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                      <td><?php echo htmlspecialchars($student['admission_no']); ?></td>
                      <td><?php echo htmlspecialchars($student['parent_email']); ?></td>
                      <td>
                        
                        <a href="#" data-bs-toggle="modal" data-bs-target="#assignStudentModal<?php echo $student['id']; ?>">
                          <i class="fa fa-chalkboard-teacher" aria-hidden="true" title="Assign to Class"></i>
                        </a>
                      </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="assignStudentModal<?php echo $student['id']; ?>" tabindex="-1" aria-labelledby="assignStudentLabel<?php echo $student['id']; ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <form method="POST" action="">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Assign <?php echo $student['fullname']; ?> to Class</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                              <div class="mb-3">
                                <label for="class_id" class="form-label">Select Class</label>
                                <select name="class_id" class="form-control" required>
                                  <option value="">-- Select Class --</option>
                                  <?php 
                                  $classList = $dbh->query("SELECT * FROM classes WHERE school_id='$school_id'")->fetchAll();
                                  foreach ($classList as $class) {
                                    echo "<option value='".$class['id']."'>".$class['name']." (".$class['section'].")</option>";
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="assign_student_btn" class="btn btn-primary">Assign</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
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

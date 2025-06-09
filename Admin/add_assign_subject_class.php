<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

if (isset($_POST['btnadd'])) {
  $subject_id = $_POST['subject_id'] ?? [];
    $class_id = $_POST['class_id'];

  // Check if subject is already assigned
  foreach ($subject_id as $id) {
    // Check if subject is already assigned
    $sql_check = "SELECT * FROM class_subjects WHERE school_id = '$school_id' AND subject_id = '$id' AND class_id = '$class_id'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
      $_SESSION['error'] = 'One or more subjects are already assigned to this class';
      continue;
    } else {
      // Insert into class_subjects
      $insert_sql = "INSERT INTO class_subjects (school_id, class_id, subject_id) VALUES ('$school_id', '$class_id', '$id')";
         
      if (mysqli_query($conn, $insert_sql)) {
        //activity log
        $operation = "Assigned Subject to Class on $current_date";
       log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

        $_SESSION['success'] = 'Subjects assigned to class successfully';
      } else {
        $_SESSION['error'] = 'Failed to assign one or more subjects to class';
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($app_name); ?> – Assign Subjects</title>
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
      <h1>Assign Subjects to Class</h1>
    </section>
    <section class="content">
      <div class="container-fluid">

       

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">New Assignment</h3>
          </div>
          <form method="POST" action="">
            <div class="card-body">
              <div class="form-group">
                <label for="class_id">Class</label>
                <select id="class_id" name="class_id" class="form-control" required>
                  <?php 
                  $class_query = "SELECT * FROM classes WHERE school_id = '$school_id'";
                  $class_result = mysqli_query($conn, $class_query);
                  while ($s = $class_result->fetch_assoc()): ?>
                  <option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['name']); ?><?php echo htmlspecialchars($s['section']); ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="subject_ids">Subjects</label>
                <select id="subject_id" name="subject_id[]" class="form-control" multiple size="6" required>
                  <?php 
                  $subjects_query = "SELECT id, name FROM subjects WHERE school_id = '$school_id'";
                  $subjects_result = mysqli_query($conn, $subjects_query);
                  while ($s = $subjects_result->fetch_assoc()): ?>
                  <option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['name']); ?>
                  </option>
                  <?php endwhile; ?>
                </select>
                <small class="form-text text-muted">
                  Hold <kbd>Ctrl</kbd> (Windows) or <kbd>⌘ Cmd</kbd> (Mac) to select multiple.
                </small>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" name="btnadd" class="btn btn-primary">Save</button>
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

<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");

}
$session_id = $row_session['id'];

if (isset($_POST['btnadd'])) {
    $exam_name = mysqli_real_escape_string($conn, $_POST['cmdexam']);

    if (empty($exam_name) ) {
        $_SESSION['error'] = "All fields are required!";
    } else {
        // Check if exam already exists
        $check = "SELECT * FROM exams WHERE school_id='$school_id' AND exam_name='$exam_name'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "This exam already exists!";
        } else {
            // Insert new exam
            $query = "INSERT INTO exams (exam_name, school_id) VALUES ('$exam_name', '$school_id')";
            if (mysqli_query($conn, $query)) {

                    //activity log
         $operation = "Created Exam: $exam_name on $current_date";
         log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

                $_SESSION['success'] = "Exam created successfully!";
            } else {
                $_SESSION['error'] = "Error saving exam. Please try again.";
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Create Exam</title>
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
            <h1>Create Exam</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Exam</li>
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
                <h3 class="card-title">Create Exam</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
           <div class="card-body">
           <div class="row">
            <div class="col-md-12">
            
            <!-- Exam Name -->
<div class="form-group">
    <label for="examName">Exam Name</label>
    <div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="cmdexam" id="midterm" value="Midterm" required>
            <label class="form-check-label" for="midterm">Midterm</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="cmdexam" id="final" value="Final" required>
            <label class="form-check-label" for="final">Final</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="cmdexam" id="mock" value="Mock" required>
            <label class="form-check-label" for="mock">Mock</label>
        </div>
    </div>
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

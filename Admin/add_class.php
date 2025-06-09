<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");

}

if (isset($_POST['btnadd'])) {
  // Sanitize inputs
  $name = mysqli_real_escape_string($conn, $_POST['txtname']);
  $section = mysqli_real_escape_string($conn, $_POST['cmdsection']);
  $next_class = mysqli_real_escape_string($conn, $_POST['txtnext_class']);

  // Validate inputs
  
      $query = "SELECT * FROM classes WHERE school_id ='$school_id' and name = '$name' and section='$section'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          $_SESSION['error'] = "Class already exists!";
      } else {

          $query = "INSERT INTO classes (school_id, name, section,next_class) VALUES ('$school_id', '$name', '$section','$next_class')";
          $result = mysqli_query($conn, $query);

          if ($result) {
          //activity log
          $operation = "Created Class: $name$section on $current_date";
          log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

      $_SESSION['success']= "$name$section created successfully!";
    }else {
              $_SESSION['error'] = "Database error: Could not create class.";
          }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Add Class</title>
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
              <li class="breadcrumb-item active">New Class</li>
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
                <h3 class="card-title">New Class</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
           <div class="card-body">
           <div class="row">
            <div class="col-md-12">
            <div class="form-group">
           <label for="exampleInputEmail1">Class Name</label>
               <input type="text" name="txtname" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtname'] ?? ''; ?>" required>
                </div>
            
            <div class="form-group">
                    <label for="exampleInputEmail1">Section</label>
                    <select id="cmdsection" name="cmdsection" class="form-control" required>
                        <option value="">--- Select Section --- </option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                        <option value="O">O</option>
                    </select>
                
        </div>
        <div class="form-group">
           <label for="exampleInputEmail1">Next Class</label>
               <input type="text" name="txtnext_class" class="form-control" id="exampleInputEmail1" value="<?php echo $_POST['txtnext_class'] ?? ''; ?>" required>
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

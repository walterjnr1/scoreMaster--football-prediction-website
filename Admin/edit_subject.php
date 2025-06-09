<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");

}
$id= $_GET['id'];
$stmt = $dbh->query("SELECT * FROM subjects where id='$id'");
$row_subject = $stmt->fetch();


if (isset($_POST['btnedit'])) {
  // Sanitize inputs
  $name = mysqli_real_escape_string($conn, $_POST['txtname']);
  $type = mysqli_real_escape_string($conn, $_POST['cmdtype']);

      
    $sql = "UPDATE subjects SET name=?, type=? where id=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$name,$type,$id]);
    if($stmt) {
      //redirect and refresh to another page after 3 seconds
      header("Refresh: 2; URL=subject_record");

        //activity log
        $operation = "Edited subject: $name on $current_date";
        log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

          $_SESSION['success']= "Subject Updated successfully!";
          } else {
              $_SESSION['error'] = "Database error: Could not Update Subject.";
          }
      }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Edit Subject </title>
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
            <h1>New Subject</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Subject</li>
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
                <h3 class="card-title">New Subject</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">subject Name</label>
                    <input type="text" name="txtname" class="form-control" id="exampleInputEmail1" value="<?php echo $row_subject['name']; ?>">
                </div>
              
                 <div class="form-group">
                    <label for="exampleInputEmail1">subject Type</label>
                    <select name="cmdtype" class="form-control" id="exampleInputEmail1" required>
                  <option value="<?php echo htmlspecialchars($row_subject['type']); ?>"><?php echo htmlspecialchars($row_subject['type']); ?></option>
                <option value="Core Subject" <?php if (isset($_POST['cmdtype']) && $_POST['cmdtype'] == 'Core Subject') echo 'selected'; ?>>Core Subject</option>
                <option value="Elective Subject" <?php if (isset($_POST['cmdtype']) && $_POST['cmdtype'] == 'Elective Subject') echo 'selected'; ?>>Elective Subject</option>
              </select>
                </div>
            </div>
       
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" name="btnedit" class="btn btn-primary">Save Changes</button>
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

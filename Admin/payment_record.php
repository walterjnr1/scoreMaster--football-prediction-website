<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
    header("Location: ../Auth/user_login");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Payment Record</title>
  <?php include('partials/head.php') ;?>
  
</script>
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
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Payment Record</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
              <div class="card">
              <div class="card-header">
                <div>
                  <h5>This Table contains data about Payments</h5>
                 
                  
                </div>
                <h3 class="card-title">&nbsp;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>s/n</th>
                    <th>Reference ID</th>
                    <th>Student Name</th>
                     <th>Admission No</th>
                    <th>Amount</th>
                    <th>Channel</th>
                    <th>Description</th>
                    <th>Payment</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php
                 $sql = "SELECT students.*, payments.* FROM students INNER JOIN payments ON students.id = payments.student_id WHERE students.school_id = '$school_id' 
                 ORDER BY payments.payment_date DESC";
								$result = $conn->query($sql);
                 $cnt=1;
                  while($row = $result->fetch_assoc()) {

										  ?>
                  <tr>
                    <td><?php echo $cnt ?></td>
                    <td><?php echo $row['reference_id'] ?></td>
                    <td><?php echo $row['fullname'] ?></td>
                    <td><?php echo $row['admission_no'] ?></td>
                    <td>GHS<?php echo number_format($row['amount'], 2); ?></td>
                    <td><?php echo $row['channel'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo $row['payment_date'] ?></td>                
                  </tr>
                  <?php $cnt=$cnt+1;} ?>

                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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

<!-- jQuery -->
<?php include('partials/bottom-script.php') ;?>

</body>
</html>
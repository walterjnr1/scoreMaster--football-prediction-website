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
  <title><?php echo $app_name; ?> | Dashboard</title>
  <?php include('partials/head.php') ;?>

  <style type="text/css">
<!--
.style1 {color: #FF0000}
-->
  </style>
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Welcome  <?php echo $row_user['name']; ?>  </h1>
            <p class="m-0 text-dark">&nbsp;</p>
            <h4 class="m-0 text-dark"><?php echo $row_school['name']; ?>, <?php echo $row_school['address']; ?>, <?php echo $row_school['region']; ?>, <?php echo $row_school['code']; ?></h4>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3><?php echo $row_user['role']; ?></h3>

                <p>Role</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>

              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $no_students['total']; ?></h3>

                <p>No. of student(s)</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-graduate"></i>

              </div>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php echo $no_teachers['total']; ?></h3>

                <p>No. of teacher(s)</p>
              </div>
              <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3><?php echo $no_subject['total']; ?></h3>

                <p>No. of subjects(s)</p>
              </div>
              <div class="icon">
              <i class="ion ion-document-text"></i> 
              </div>
            </div>
          </div>
          <!-- ./col -->
         
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <h3><?php echo $no_classes['total']; ?></h3>

                <p>No. of class</p>
              </div>
              <div class="icon">
              <i class="ion ion-home"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
              <h3><?php echo $row_session['session']; ?></h3>

                <p>Current Academic Session</p>
              </div>
              <div class="icon">
              <i class="fas fa-calendar-alt"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-pink">
              <div class="inner">
              <h3>GHS<?php echo $sms_balance; ?></h3>

                <p>SMS balanace</p>
              </div>
              <div class="icon">
              <i class="fas fa-calendar-alt"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>GHS<?php echo number_format($total_paid['total_paid'], 2); ?></h3>
                <p>Income</p>
              </div>
              <div class="icon">
              <i class="ion ion-cash"></i>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          
          <div class="row">
  <div class="col-lg-18">
    <div class="card card-outline card-secondary">
      <div class="card-header">
        <h3 class="card-title">Recent Activity Logs . <span class="style1">It displays only last 10 activities</span></h3>
      </div>
      <div class="card-body table-responsive p-0" style="max-height: 300px;">
        <table width="986" align="center" class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th width="431"><div align="center">S/N</div></th>
              <th width="431"><div align="center">Name</div></th>
              <th width="287"><div align="center">Operation</div></th>
              <th width="252"><div align="center">IP Address</div></th>
            </tr>
          </thead>
          <tbody>
            <?php 
           
        $sql = "SELECT activity_logs.*, users.name AS user_name FROM activity_logs JOIN users ON activity_logs.user_id = users.id WHERE activity_logs.school_id = '$school_id' ORDER BY activity_logs.id DESC 
          LIMIT 10";
        $result = $conn->query($sql);
        $cnt = 1;
        while ($row = $result->fetch_assoc()) {

						?>
                  <tr>
                    <td><div align="center"><?php echo $cnt ?></div></td>
                  <td><div align="center"><?php echo htmlspecialchars($row['user_name']); ?></div></td>
                  <td><div align="center"><?php echo htmlspecialchars($row['operation']); ?></div></td>
                  <td><div align="center"><?php echo htmlspecialchars($row['ip_address']); ?></div></td>
                </tr>
                <?php $cnt=$cnt+1;} ?>
                </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
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

<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Permissions Record</title>
  <?php include('partials/head.php'); ?>

  <script type="text/javascript">
  // Confirm deletion action
  function deldata() {
    if(confirm("ARE YOU SURE YOU WISH TO DELETE THIS PERMISSION?")) {
      return true;
    } else {
      return false;
    }
  }
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('partials/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include('partials/sidebar.php'); ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permissions Record</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Permissions Record</li>
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
                  <h5>This Table contains data about Permissions</h5>
                  <a href="save_permissions"><button type="submit" name="btnadd" class="btn btn-primary">New Permission</button></a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>s/n</th>
                    <th>Role</th>
                    <th>Module</th>
                    <th>Permission Type</th>
                    <th>Access Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                          // Fetch permission data from the database
                          $sql = "SELECT * FROM permissions WHERE school_id='$school_id' ORDER BY role ASC";
                          $result = $conn->query($sql);
                          $cnt = 1;
                          while($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                    <td><?php echo $cnt ?></td>
                    <td><?php echo $row['role'] ?></td>
                    <td><?php echo $row['module'] ?></td>
                    <td><?php echo $row['permission_type'] ?></td>
                    <td><?php if ($row['can_access'] == 1) { 
                      echo '<span style="color: green;">Permitted</span>';
                      } else { 
                        echo '<span style="color: red;">Not Permitted</span>';
                      }
                      ?>
                    </td>


                    <td>
                      <?php if (!empty($permissions['permission record']['delete'])): ?>      
                        <a href="delete_permission?id=<?php echo $row['id'];?>" onClick="return deldata();">
                          <i class="fa fa-trash" aria-hidden="true" title="Delete Permission Record"></i>
                        </a>  
                     
                        <?php else: ?>
                        <i class="fa fa-trash text-muted" aria-hidden="true" title="Delete Permission"></i>
                      <?php endif; ?>
                    </td>

                    
                  </tr>
                  <?php 
                    $cnt++; 
                  } 
                  ?>
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
    <strong><?php include('partials/footer.php'); ?></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php include('partials/bottom-script.php'); ?>

</body>
</html>

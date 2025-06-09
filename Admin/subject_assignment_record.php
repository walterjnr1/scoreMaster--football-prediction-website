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
  <title><?php echo $app_name; ?> | Subject Allocation Record</title>
  <?php include('partials/head.php') ;?>
  
<script type="text/javascript">
function deldata(){
if(confirm("ARE YOU SURE YOU WISH TO DELETE THIS SUBJECT ASSIGNMENT RECORD ?" ))
{
return  true;
}
else {return false;
}
	 
}
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
              <li class="breadcrumb-item active">Subject Allocation Record</li>
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
                  <h5>This Table contains data about subject Allocation to class</h5>
                  <?php if (!empty($permissions['subject assignment record']['create'])): ?>      
                  <a href="add_assign_subject_class"><button type="submit" name="btnadd" class="btn btn-primary">New Subject Allocation to class</button></a>
                  <?php endif?>
                </div>
                <h3 class="card-title">&nbsp;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>s/n</th>
                    <th>subject</th>
                    <th>Class</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php
        $sql_allocation = "SELECT st.id, s.name AS subject, c.name AS class , c.section AS section
               FROM class_subjects st 
               INNER JOIN classes c ON st.class_id = c.id 
               INNER JOIN subjects s ON st.subject_id = s.id 
               WHERE st.school_id = '$school_id' 
               ORDER BY st.id DESC";
        $result = $conn->query($sql_allocation);
                      if (!$result) {
                          die("Error executing query: " . $conn->error);
                      }
          
                      $cnt = 1;
                      while ($row = $result->fetch_assoc()) {
          ?>
                            <tr>
                              <td><?php echo $cnt; ?></td>
                              <td><?php echo htmlspecialchars($row['subject']); ?></td>
                              <td><?php echo htmlspecialchars($row['class'].$row['section']); ?></td>
                  

           <td>
           <?php if (!empty($permissions['subject assignment record']['delete'])): ?>      
            <a href="delete_assign_subject?id=<?php echo $row['id'];?>" onClick="return deldata();">
                          <i class="fa fa-trash" aria-hidden="true" title="Delete Record"></i>
                        </a>  
                     <?php endif ?>
                        <?php if (!empty($permissions['subject assignment record']['update'])): ?>      

                       
                      <?php else: ?>
                        <i class="fa fa-trash text-muted" aria-hidden="true" title="Delete Subject Assignment Record"></i>
                      <?php endif; ?>
                    </td>
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

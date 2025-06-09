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
if(confirm("ARE YOU SURE YOU WISH TO DELETE THIS SUBJECT ALLOCATION ?" ))
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
                  <h5>This Table contains data about subject Allocation</h5>
                  <?php if (!empty($permissions['subject allocation record']['create'])): ?>      
                  <a href="add_subject_allocation"><button type="submit" name="btnadd" class="btn btn-primary">New Subject Allocation</button></a>
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
                    <th>Teacher</th>
                    <th>Class</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php
            $sql_allocation = "SELECT st.id, u.name AS teacher, s.name AS subject, c.name AS class 
            FROM subject_teacher st 
            JOIN users u ON st.user_id = u.id 
            JOIN subjects s ON st.subject_id = s.id 
            JOIN classes c ON st.class_id = c.id 
            WHERE st.school_id='$school_id' 
            ORDER BY u.name DESC";
            $result = $conn->query($sql_allocation);
            $cnt=1;
           while($row = $result->fetch_assoc()) {

								?>
                  <tr>
                    <td><?php echo $cnt ?></td>
                    <td><?php echo $row['subject'] ?></td>
                    <td><?php echo $row['teacher'] ?></td>
                    <td><?php echo $row['class'] ?></td>
                  

           <td>
           <?php if (!empty($permissions['subject allocation record']['delete'])): ?>      
            <a href="delete_subject_allocation?id=<?php echo $row['id'];?>" onClick="return deldata();">
                          <i class="fa fa-trash" aria-hidden="true" title="Delete Record"></i>
                        </a>  
                     <?php endif ?>
                        <?php if (!empty($permissions['subject allocation record']['update'])): ?>      

                        <a href="edit_subject_allocation?id=<?php echo $row['id'];?>">
                          <i class="fa fa-edit" aria-hidden="true" title="Edit Record"></i>
                        </a>
                      <?php else: ?>
                        <i class="fa fa-trash text-muted" aria-hidden="true" title="Delete Subject Allocation Record"></i>
                        <i class="fa fa-edit text-muted" aria-hidden="true" title="Edit Subject Allocation Record"></i>
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

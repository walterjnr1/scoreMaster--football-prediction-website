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
  <title><?php echo $app_name; ?> | Scratch Card Record</title>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Scratch Card Record</li>
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
                  <h5>This Table contains data about Scratch Cards</h5>
                  <a href="generate_scratch_cards"><button type="submit" name="btnadd" class="btn btn-primary">New Scratch Card</button> 
                  </a>
                  <a href="print_scratch_cards" target="_blank" class="btn btn-success">
             <i class="fa fa-print" aria-hidden="true"></i> Print Scratch Card
              </a>
                </div>
                <h3 class="card-title">&nbsp;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table width="626" height="98" class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                    <th width="19">s/n</th>
                    <th width="53">PIN</th>
                    <th width="73">Serial No.</th>
                    <th width="81">Status</th>
                   <th width="81">Card type</th>
                    <th width="25">Used By Student</th>
                    <th width="25">Used By Exams</th>
                  <th width="25">Used By Session/Term</th>
                    <th width="25">Date Used</th>
                    <th width="25">Usage Count</th>
                  <th width="25">Maximum Usage</th>
                     <th width="150">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                $data = $dbh->query("SELECT sc.*, sess.*, s.fullname AS student_name, e.exam_name FROM scratch_cards sc 
                LEFT JOIN students s ON sc.used_by_student_id = s.id  LEFT JOIN exams e ON sc.used_by_exam_id = e.id LEFT JOIN academic_session sess ON sc.used_by_session_id = sess.id 
                WHERE sc.school_id='$school_id'")->fetchAll();
                $cnt = 1;
                foreach ($data as $row) {
                ?>
                <tr>
                <td height="52"><?php echo $cnt; ?></td>
                <td><?php echo htmlspecialchars($row['pin']); ?></td>
                <td><?php echo htmlspecialchars($row['serial_number']); ?></td>
                <td style="color: <?php echo $row['is_used'] == 1 ? 'red' : 'green'; ?>;">
                  <?php echo $row['is_used'] == 1 ? 'Used' : 'Unused'; ?>
                </td>
                <td><?php echo htmlspecialchars($row['card_type'] ?? 'N/A'); ?></td>
               <td><?php echo htmlspecialchars($row['student_name'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($row['exam_name'] ?? 'N/A'); ?></td>
                <td><?php if (!empty($row['session']) && !empty($row['term'])) {
                echo htmlspecialchars($row['session'] . '-' . $row['term'] . ' Term');
                } else { echo 'N/A'; } ?>
                </td>
                <td><?php echo htmlspecialchars($row['used_on'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($row['usage_count']); ?></td>
                 <td><?php echo htmlspecialchars($row['max_usage']); ?></td>

                
                <td>
                      <?php if (!empty($permissions['scratch card record']['delete'])): ?>      
                        <a href="delete_scratch_card?id=<?php echo $row['id'];?>" onClick="return deldata();">
                          <i class="fa fa-trash" aria-hidden="true" title="Delete Record"></i>
                        </a>  
                     
                        <?php elseif (!empty($permissions['scratch card record']['update'])): ?>      

                        <a href="edit_scratch_card?id=<?php echo $row['id'];?>">
                          <i class="fa fa-edit" aria-hidden="true" title="Edit Record"></i>
                        </a>
                      <?php else: ?>
                        <i class="fa fa-trash text-muted" aria-hidden="true" title="Delete Scratch card"></i>
                        <i class="fa fa-edit text-muted" aria-hidden="true" title="Edit Scratch card"></i>
                      <?php endif; ?>
                    </td>

                </tr>
                <?php $cnt++; } ?>
                

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

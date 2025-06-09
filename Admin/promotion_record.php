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
  <title><?= htmlspecialchars($app_name); ?> | Promotion Record</title>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1>Promotion Record</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Promotion Record</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h5>Table showing Promotion Records</h5>
            
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>From Class</th>
                <th>To Class</th>
                <th>Academic Year</th>
                <th>Date of Promotion</th>
              </tr>
              </thead>
              <tbody>
              <?php
              // Fetch promotion records with student and class info
              $sql = "
              SELECT 
                p.id,
                s.fullname AS student_name,
                c_from.name AS from_class,
                c_from.section AS from_section,
                c_to.name AS to_class,
                c_to.section AS to_section,
                asess.session AS academic_year,
                p.promoted_on
              FROM promotions p
              JOIN students s ON p.student_id = s.id
              JOIN classes c_from ON p.from_class_id = c_from.id
              JOIN classes c_to ON p.to_class_id = c_to.id
              JOIN academic_session asess ON p.session_id = asess.id
              WHERE p.school_id = ?
              ORDER BY p.promoted_on DESC
              ";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $school_id);
              $stmt->execute();
              $result = $stmt->get_result();
              $cnt = 1;
              while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><?= $cnt++; ?></td>
                <td><?= htmlspecialchars($row['student_name']); ?></td>
                <td><?= htmlspecialchars($row['from_class'] . ' ' . $row['from_section']); ?></td>
                <td><?= htmlspecialchars($row['to_class'] . ' ' . $row['to_section']); ?></td>
                <td><?= htmlspecialchars($row['academic_year']); ?></td>
                <td><?= htmlspecialchars(date('Y-m-d', strtotime($row['promoted_on']))); ?></td>
              </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <?php include('partials/footer.php'); ?>
  </footer>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<?php include('partials/bottom-script.php'); ?>
</body>
</html>

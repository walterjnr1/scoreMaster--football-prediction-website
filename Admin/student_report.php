<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
  exit();
}

// Handle search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = "WHERE students.school_id='$school_id'";
$params = [];

if ($search !== '') {
  $where .= " AND ( students.fullname LIKE :search OR students.sex LIKE :search OR students.dob LIKE :search OR
    students.address LIKE :search OR students.region LIKE :search OR students.district LIKE :search OR students.previous_school LIKE :search OR
    classes.name LIKE :search OR students.admission_no LIKE :search OR students.class_id LIKE :search OR
    students.parent_email LIKE :search OR students.parent_phone LIKE :search )";
  $params[':search'] = "%$search%";
}

// Always filter by school_id in all queries
$sql = "SELECT students.*, classes.section AS section, classes.name AS class FROM students INNER JOIN classes ON students.class_id=classes.id 
$where ORDER BY students.fullname ASC";
$stmt = $dbh->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll();

$operation = "Generated a student Report on $current_date";
log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Student Report</title>
  <?php include('partials/head.php'); ?>
  <style>
    .print-btn {
      margin-top: 20px;
      margin-bottom: 10px;
      border-radius: 20px;
      padding: 8px 24px;
      font-size: 16px;
      background: #28a745;
      color: #fff;
      border: none;
      transition: background 0.2s;
      float: right;
    }
    .print-btn:hover {
      background: #218838;
    }
    .custom-search-box {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .custom-search-box input[type="text"] {
      border-radius: 20px;
      border: 1px solid #ced4da;
      padding: 6px 16px;
      font-size: 15px;
      width: 250px;
      transition: border 0.2s;
    }
    .custom-search-box button {
      border-radius: 20px;
      padding: 6px 18px;
      font-size: 15px;
      background: #007bff;
      color: #fff;
      border: none;
      transition: background 0.2s;
    }
    .custom-search-box button:hover {
      background: #0056b3;
    }
    @media print {
      body * {
        visibility: hidden !important;
      }
      #printable-area, #printable-area * {
        visibility: visible !important;
      }
      #printable-area {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
      }
      .print-btn, .main-footer, .navbar, .main-sidebar, .control-sidebar, .custom-search-box {
        display: none !important;
      }
      table {
        font-size: 13px;
      }
    }
    .table-report {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      background: #fff;
      box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }
    .table-report th, .table-report td {
      border: 1px solid #dee2e6;
      padding: 8px 10px;
      text-align: left;
      vertical-align: middle;
    }
    .table-report th {
      background: #343a40;
      color: #fff;
      font-weight: 600;
      font-size: 15px;
    }
    .table-report tr:nth-child(even) {
      background: #f8f9fa;
    }
    .student-photo {
      width: 50px; height: 50px; object-fit: cover; border-radius: 50%;
      border: 2px solid #dee2e6;
      background: #fff;
    }
    .badge-status {
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 13px;
      font-weight: 500;
      display: inline-block;
    }
    .badge-active { background: #d4edda; color: #155724; }
    .badge-inactive { background: #f8d7da; color: #721c24; }
    .report-title {
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 10px;
      margin-top: 10px;
      color: #343a40;
      letter-spacing: 1px;
    }
    .report-meta {
      text-align: center;
      font-size: 16px;
      margin-bottom: 20px;
      color: #555;
    }
  </style>
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
          <div class="col-sm-6">
            <h1>Student Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Student Report</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card" style="box-shadow:0 2px 12px rgba(0,0,0,0.06);">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Student Report</h5>
              </div>
                <div class="card-body">
                <!-- Custom Search Box -->
                <form class="custom-search-box" method="get" action="">
                  <input type="text" name="search" placeholder="Search students..." value="<?php echo htmlspecialchars($search); ?>" />
                  <button type="submit"><i class="fa fa-search"></i> Search</button>
                  <?php if ($search !== ''): ?>
                  <a href="student_report.php" class="btn btn-secondary" style="border-radius:20px;padding:6px 18px;font-size:15px;">Reset</a>
                  <?php endif; ?>
                </form>
                <!-- Printable Area -->
                <div id="printable-area">
                  <div class="report-title"><?php echo $app_name; ?> - Student Report</div>
                  <div class="report-meta">
                    Date: <?php echo date('d M Y'); ?>
                    <?php if ($search !== ''): ?>
                      <br>Search: <strong><?php echo htmlspecialchars($search); ?></strong>
                    <?php endif; ?>
                  </div>
                  <table class="table-report">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Photo</th>
                    <th>Admission No</th>
                    <th>Full Name</th>
                    <th>Sex</th>
                    <th>DOB</th>
                    <th>Class</th>
                    <th>Address</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Previous School</th>
                    <th>Status</th>
                    <th>Parent Phone</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $cnt = 1;
                  if (count($data) > 0):
                  foreach ($data as $row): ?>
                    <tr>
                    <td><?php echo $cnt; ?></td>
                    <td>
                      <img src="../<?php echo (!empty($row['photo'])) ? htmlspecialchars($row['photo']) : 'uploadImage/Profile/default.png'; ?>" class="student-photo" />
                    </td>
                    <td><?php echo htmlspecialchars($row['admission_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($row['sex']); ?></td>
                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                    <td><?php echo htmlspecialchars($row['class'] . ' ' . $row['section']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['region']); ?></td>
                    <td><?php echo htmlspecialchars($row['district']); ?></td>
                    <td><?php echo htmlspecialchars($row['previous_school']); ?></td>
                    <td>
                      <?php if ($row['status'] == 1): ?>
                      <span class="badge-status badge-active">Active</span>
                      <?php else: ?>
                      <span class="badge-status badge-inactive">Inactive</span>
                      <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['parent_phone']); ?></td>
                    </tr>
                  <?php $cnt++; endforeach; else: ?>
                    <tr>
                    <td colspan="13" class="text-center text-danger">No student found.</td>
                    </tr>
                  <?php endif; ?>
                  </tbody>
                  </table>
                </div>
                <!-- Print button here, prints only the div -->
                <!-- Print button -->
<button class="print-btn" onclick="openPrintWindow(); return false;"><i class="fa fa-print"></i> Print Report</button>

<!-- Hidden Print Template -->
<textarea id="print-template" style="display:none;">
<!DOCTYPE html>
<html>
<head>
  <title>Print - Student Report</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; margin: 20px; }
    .report-title {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #343a40;
    }
    .report-meta {
      text-align: center;
      font-size: 14px;
      margin-bottom: 20px;
      color: #555;
    }
    .table-report {
      width: 100%;
      border-collapse: collapse;
    }
    .table-report th, .table-report td {
      border: 1px solid #000;
      padding: 6px;
      text-align: left;
    }
    .table-report th {
      background-color: #f2f2f2;
    }
    .student-photo {
      width: 40px; height: 40px; object-fit: cover; border-radius: 50%;
    }
  </style>
</head>
<body>
  <div class="report-title"><?php echo $app_name; ?> - Student Report</div>
  <div class="report-meta">
    Date: <?php echo date('d M Y'); ?>
    <?php if ($search !== ''): ?>
    <br>Search: <strong><?php echo htmlspecialchars($search); ?></strong>
    <?php endif; ?>
  </div>
  <table class="table-report">
    <thead>
      <tr>
        <th>S/N</th>
        <th>Photo</th>
        <th>Admission No</th>
        <th>Full Name</th>
        <th>Sex</th>
        <th>DOB</th>
        <th>Class</th>
        <th>Address</th>
        <th>Region</th>
        <th>District</th>
        <th>Previous School</th>
        <th>Status</th>
        <th>Parent Phone</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $cnt = 1;
    if (count($data) > 0):
      foreach ($data as $row): ?>
      <tr>
        <td><?php echo $cnt; ?></td>
        <td><img src="../<?php echo (!empty($row['photo']) ? htmlspecialchars($row['photo']) : 'uploadImage/Profile/default.png'); ?>" class="student-photo" /></td>
        <td><?php echo htmlspecialchars($row['admission_no']); ?></td>
        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
        <td><?php echo htmlspecialchars($row['sex']); ?></td>
        <td><?php echo htmlspecialchars($row['dob']); ?></td>
        <td><?php echo htmlspecialchars($row['class'] . ' ' . $row['section']); ?></td>
        <td><?php echo htmlspecialchars($row['address']); ?></td>
        <td><?php echo htmlspecialchars($row['region']); ?></td>
        <td><?php echo htmlspecialchars($row['district']); ?></td>
        <td><?php echo htmlspecialchars($row['previous_school']); ?></td>
        <td><?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
        <td><?php echo htmlspecialchars($row['parent_phone']); ?></td>
      </tr>
    <?php $cnt++; endforeach; else: ?>
      <tr>
        <td colspan="13">No student found.</td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
  <script>
    window.onload = function() {
      window.print();
    }
  </script>
</body>
</html>
</textarea>

<script>
function openPrintWindow() {
  const printContent = document.getElementById("print-template").value;
  const printWindow = window.open("", "", "width=900,height=650");
  printWindow.document.write(printContent);
  printWindow.document.close();
}
</script>

                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <strong><?php include('partials/footer.php'); ?></strong>
    <div class="float-right d-none d-sm-inline-block"></div>
  </footer>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<?php include('partials/bottom-script.php'); ?>

</body>
</html>

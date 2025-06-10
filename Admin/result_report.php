<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
    header("Location: ../login");

}

$school_id = $_SESSION['school_id'];

// Handle search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = "WHERE er.school_id = ?";
$params = [$school_id];
$types = "i";

// Join students, exams, academic_session, classes tables
$join = "
  JOIN students s ON er.student_id = s.id
  JOIN exams ex ON er.exam_id = ex.id
  JOIN academic_session asess ON er.session_id = asess.id
  JOIN classes c ON er.class_id = c.id
";

// Search by student name, exam name, admission no, session, term, total_mark, class, term, overall position
if ($search !== '') {
  $where .= " AND ( 
    s.fullname LIKE ? OR
    s.admission_no LIKE ? OR
    ex.exam_name LIKE ? OR
    asess.session LIKE ? OR
    asess.term LIKE ? OR
    er.total_mark LIKE ? OR
    c.name LIKE ? OR
    asess.term LIKE ? 
  )";
  // 8 search params
  for ($i = 0; $i < 8; $i++) {
    $params[] = "%$search%";
    $types .= "s";
  }
}

// Fetch grouped results for report
$sql = "
  SELECT
    er.student_id,
    s.fullname,
    s.class_id,
    s.sex,
    s.admission_no,
    s.photo,
    er.class_id,
    er.session_id,
    er.exam_id,
    ex.exam_name,
    asess.session AS academic_session,
    asess.term,
    SUM(er.total_mark) AS total_marks,
    AVG(er.total_mark) AS average_marks
  FROM exam_results er
  $join
  $where
  GROUP BY er.student_id, er.class_id, er.session_id, er.exam_id
  ORDER BY er.class_id, er.session_id, er.exam_id, total_marks DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$results = [];
while ($row = $result->fetch_assoc()) {
  $key = $row['class_id'] . '_' . $row['session_id'] . '_' . $row['exam_id'];
  $results[$key][] = $row;
}

// Fetch class names for mapping
$class_map = [];
$class_sql = "SELECT id, name FROM classes WHERE school_id = ?";
$class_stmt = $conn->prepare($class_sql);
$class_stmt->bind_param("i", $school_id);
$class_stmt->execute();
$class_res = $class_stmt->get_result();
while ($c = $class_res->fetch_assoc()) {
  $class_map[$c['id']] = $c['name'];
}

$operation = "Generated a result Report on " . date('Y-m-d');
log_activity($conn, $school_id, $_SESSION['user_id'], $_SESSION['role'], $operation, $_SERVER['REMOTE_ADDR']);

function ordinal_suffix($num) {
  if (!in_array(($num % 100), [11, 12, 13])) {
    switch ($num % 10) {
      case 1: return $num . 'st';
      case 2: return $num . 'nd';
      case 3: return $num . 'rd';
    }
  }
  return $num . 'th';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $app_name; ?> | Result Report</title>
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
    .print-btn:hover { background: #218838; }
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
    .custom-search-box button:hover { background: #0056b3; }
    @media print {
      body * { visibility: hidden !important; }
      #printable-area, #printable-area * { visibility: visible !important; }
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
      table { font-size: 13px; }
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
    .table-report tr:nth-child(even) { background: #f8f9fa; }
    .student-photo {
      width: 40px; height: 40px; object-fit: cover; border-radius: 50%;
      border: 2px solid #dee2e6;
      background: #fff;
    }
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
            <h1>Result Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Result Report</li>
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
                <h5 class="mb-0">Result Report</h5>
              </div>
              <div class="card-body">
                <!-- Custom Search Box -->
                <form class="custom-search-box" method="get" action="">
                  <input type="text" name="search" placeholder="Search by Name, Admission No, Exam, Session, Term, Total Mark, Class, Position..." value="<?php echo htmlspecialchars($search); ?>" />
                  <button type="submit"><i class="fa fa-search"></i> Search</button>
                  <?php if ($search !== ''): ?>
                    <a href="result_report" class="btn btn-secondary" style="border-radius:20px;padding:6px 18px;font-size:15px;">Reset</a>
                  <?php endif; ?>
                </form>
                <!-- Printable Area -->
                <div id="printable-area">
                  <div class="report-title"><?php echo $app_name; ?> - Result Report</div>
                  <div class="report-meta">
                    Date: <?php echo date('d M Y'); ?>
                    <?php if ($search !== ''): ?>
                      <br>Search: <strong><?php echo htmlspecialchars($search); ?></strong>
                    <?php endif; ?>
                  </div>
                  <table class="table-report">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Admission No</th>
                        <th>Full Name</th>
                        <th>Sex</th>
                        <th>Class</th>
                        <th>Session</th>
                        <th>Term</th>
                        <th>Exam Type</th>
                        <th>Total Marks</th>
                        <th>Average Marks</th>
                        <th>Overall Position</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cnt = 1;
                    $search_position = false;
                    $search_position_num = 0;
                    // Check if search is for position (e.g. "1st", "2nd", "3rd", "4th", etc.)
                    if ($search !== '') {
                      if (preg_match('/^(\d+)(st|nd|rd|th)$/i', $search, $m)) {
                        $search_position = true;
                        $search_position_num = (int)$m[1];
                      }
                    }
                    if (!empty($results)) {
                      foreach ($results as $group) {
                        usort($group, fn($a, $b) => $b['total_marks'] <=> $a['total_marks']);
                        $rank = 1;
                        foreach ($group as $row) {
                          // If searching for position, only show matching rank
                          if ($search_position && $rank !== $search_position_num) {
                            $rank++;
                            continue;
                          }
                          ?>
                          <tr>
                            <td><?= $cnt++; ?></td>
                            <td>
                              <img src="../<?= !empty($row['photo']) ? htmlspecialchars($row['photo']) : 'uploadImage/Profile/default.png'; ?>" class="student-photo" />
                            </td>
                            <td><?= htmlspecialchars($row['admission_no']); ?></td>
                            <td><?= htmlspecialchars($row['fullname']); ?></td>
                            <td><?= htmlspecialchars($row['sex']); ?></td>
                            <td><?= htmlspecialchars(isset($class_map[$row['class_id']]) ? $class_map[$row['class_id']] : ''); ?></td>
                            <td><?= htmlspecialchars($row['academic_session']); ?></td>
                            <td><?= htmlspecialchars($row['term']); ?></td>
                            <td><?= htmlspecialchars($row['exam_name']); ?></td>
                            <td><?= htmlspecialchars($row['total_marks']); ?></td>
                            <td><?= htmlspecialchars(number_format($row['average_marks'], 2)); ?></td>
                            <td><?= ordinal_suffix($rank++); ?></td>
                          </tr>
                          <?php
                        }
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="12" class="text-center text-danger">No Result found.</td>
                      </tr>
                      <?php
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- Print button -->
                <button class="print-btn" onclick="openPrintWindow(); return false;"><i class="fa fa-print"></i> Print Report</button>

                <!-- Hidden Print Template -->
                <textarea id="print-template" style="display:none;">
<!DOCTYPE html>
<html>
<head>
  <title>Print - Result Report</title>
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
      width: 30px; height: 30px; object-fit: cover; border-radius: 50%;
    }
  </style>
</head>
<body>
  <div class="report-title"><?php echo $app_name; ?> - Result Report</div>
  <div class="report-meta">
    Date: <?php echo date('d M Y'); ?>
    <?php if ($search !== ''): ?>
    <br>Search: <strong><?php echo htmlspecialchars($search); ?></strong>
    <?php endif; ?>
  </div>
  <table class="table-report">
    <thead>
      <tr>
        <th>#</th>
        <th>Photo</th>
        <th>Admission No</th>
        <th>Full Name</th>
        <th>Sex</th>
        <th>Class</th>
        <th>Session</th>
        <th>Term</th>
        <th>Exam Type</th>
        <th>Total Marks</th>
        <th>Average Marks</th>
        <th>Overall Position</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $cnt = 1;
    $search_position = false;
    $search_position_num = 0;
    if ($search !== '') {
      if (preg_match('/^(\d+)(st|nd|rd|th)$/i', $search, $m)) {
        $search_position = true;
        $search_position_num = (int)$m[1];
      }
    }
    if (!empty($results)) {
      foreach ($results as $group) {
        usort($group, fn($a, $b) => $b['total_marks'] <=> $a['total_marks']);
        $rank = 1;
        foreach ($group as $row) {
          if ($search_position && $rank !== $search_position_num) {
            $rank++;
            continue;
          }
          ?>
          <tr>
            <td><?= $cnt++; ?></td>
            <td>
              <img src="../<?= !empty($row['photo']) ? htmlspecialchars($row['photo']) : 'uploadImage/Profile/default.png'; ?>" class="student-photo" />
            </td>
            <td><?= htmlspecialchars($row['admission_no']); ?></td>
            <td><?= htmlspecialchars($row['fullname']); ?></td>
            <td><?= htmlspecialchars($row['sex']); ?></td>
            <td><?= htmlspecialchars(isset($class_map[$row['class_id']]) ? $class_map[$row['class_id']] : ''); ?></td>
            <td><?= htmlspecialchars($row['academic_session']); ?></td>
            <td><?= htmlspecialchars($row['term']); ?></td>
            <td><?= htmlspecialchars($row['exam_name']); ?></td>
            <td><?= htmlspecialchars($row['total_marks']); ?></td>
            <td><?= htmlspecialchars(number_format($row['average_marks'], 2)); ?></td>
            <td><?= ordinal_suffix($rank++); ?></td>
          </tr>
          <?php
        }
      }
    } else {
      ?>
      <tr>
        <td colspan="12" class="text-center text-danger">No Result found.</td>
      </tr>
      <?php
    }
    ?>
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

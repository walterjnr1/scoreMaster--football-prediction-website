<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
  exit;
}

$school_id = $_SESSION['school_id'];

// Fetch dropdown data
// Classes & Sections
$class_options = [];
$class_sql = "SELECT id, name AS class_name, section AS section_name 
              FROM classes     
              WHERE school_id = ?";
$stmt = $conn->prepare($class_sql);
$stmt->bind_param("i", $school_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
  $display = $row['class_name'];
  if (!empty($row['section_name'])) {
    $display .= " - " . $row['section_name'];
  }
  $class_options[$row['id']] = $display;
}

// Sessions (distinct)
$session_options = [];
$session_sql = "SELECT DISTINCT session FROM academic_session WHERE school_id = ?";
$stmt = $conn->prepare($session_sql);
$stmt->bind_param("i", $school_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
  $session_options[] = $row['session'];
}

// Terms
$term_options = [];
$term_sql = "SELECT DISTINCT term FROM academic_session WHERE school_id = ?";
$stmt = $conn->prepare($term_sql);
$stmt->bind_param("i", $school_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
  $term_options[] = $row['term'];
}

// Subjects
$subject_options = [];
$subject_sql = "SELECT id, name FROM subjects WHERE school_id = ?";
$stmt = $conn->prepare($subject_sql);
$stmt->bind_param("i", $school_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
  $subject_options[$row['id']] = $row['name'];
}

// Exams
$exam_options = [];
$exam_sql = "SELECT id, exam_name FROM exams WHERE school_id = ?";
$stmt = $conn->prepare($exam_sql);
$stmt->bind_param("i", $school_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
  $exam_options[$row['id']] = $row['exam_name'];
}

// Handle filters
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : '';
$session_val = isset($_GET['session_id']) ? trim($_GET['session_id']) : '';
$term = isset($_GET['term']) ? trim($_GET['term']) : '';
$subject_id = isset($_GET['subject_id']) ? intval($_GET['subject_id']) : '';
$exam_id = isset($_GET['exam_id']) ? intval($_GET['exam_id']) : '';

$where = "WHERE er.school_id = ?";
$params = [$school_id];
$types = "i";

if ($class_id) {
  $where .= " AND er.class_id = ?";
  $params[] = $class_id;
  $types .= "i";
}
if ($session_val) {
  $where .= " AND asess.session = ?";
  $params[] = $session_val;
  $types .= "s";
}
if ($term) {
  $where .= " AND asess.term = ?";
  $params[] = $term;
  $types .= "s";
}
if ($subject_id) {
  $where .= " AND er.subject_id = ?";
  $params[] = $subject_id;
  $types .= "i";
}
if ($exam_id) {
  $where .= " AND er.exam_id = ?";
  $params[] = $exam_id;
  $types .= "i";
}

// Main query
$sql = "
SELECT
  er.id,
  s.fullname,
  s.admission_no,
  s.sex,
  s.photo,
  c.name AS class_name,
  c.section AS section_name,
  asess.session AS academic_session,
  asess.term,
  subj.name AS subject_name,
  ex.exam_name,
  er.test_score,
  er.exam_score,
  er.total_mark,
  g.grade,
  er.position_in_subject
FROM exam_results er
JOIN students s ON er.student_id = s.id
JOIN classes c ON er.class_id = c.id
JOIN academic_session asess ON er.session_id = asess.id
JOIN subjects subj ON er.subject_id = subj.id
JOIN exams ex ON er.exam_id = ex.id
LEFT JOIN grades g ON g.school_id = er.school_id AND er.total_mark BETWEEN g.min_score AND g.max_score
$where
ORDER BY er.class_id, asess.session, er.subject_id, er.exam_id, er.total_mark DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$results = [];
while ($row = $result->fetch_assoc()) {
  $results[] = $row;
}

$operation = "Generated a score Report on " . date('Y-m-d');
log_activity($conn, $school_id, $_SESSION['user_id'], $_SESSION['role'], $operation, $_SERVER['REMOTE_ADDR']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $app_name; ?> | Score Report</title>
  <?php include('partials/head.php'); ?>
  <style>
    .filter-row { display: flex; gap: 10px; margin-bottom: 20px; }
    .filter-row select { border-radius: 20px; padding: 6px 16px; font-size: 15px; }
    .filter-row button { border-radius: 20px; padding: 6px 18px; font-size: 15px; background: #007bff; color: #fff; border: none; }
    .filter-row button:hover { background: #0056b3; }
    .print-btn { margin-top: 20px; margin-bottom: 10px; border-radius: 20px; padding: 8px 24px; font-size: 16px; background: #28a745; color: #fff; border: none; float: right; }
    .print-btn:hover { background: #218838; }
    .table-report { width: 100%; border-collapse: collapse; margin-bottom: 20px; background: #fff; }
    .table-report th, .table-report td { border: 1px solid #dee2e6; padding: 8px 10px; text-align: left; }
    .table-report th { background: #343a40; color: #fff; }
    .student-photo { width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid #dee2e6; background: #fff; }
    .report-title { text-align: center; font-size: 28px; font-weight: bold; margin-bottom: 10px; margin-top: 10px; color: #343a40; }
    .report-meta { text-align: center; font-size: 16px; margin-bottom: 20px; color: #555; }
    @media print {
      body * { visibility: hidden !important; }
      #printable-area, #printable-area * { visibility: visible !important; }
      #printable-area { position: absolute !important; left: 0 !important; top: 0 !important; width: 100% !important; }
      .print-btn, .main-footer, .navbar, .main-sidebar, .control-sidebar, .filter-row { display: none !important; }
      table { font-size: 13px; }
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
          <div class="col-sm-6"><h1>Score Report</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Score Report</li>
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
                <h5 class="mb-0">Score Report</h5>
              </div>
              <div class="card-body">
                <!-- Filter Row -->
                <form class="filter-row" method="get" action="">
                  <select name="class_id">
                    <option value="">All Classes</option>
                    <?php foreach ($class_options as $id => $name): ?>
                      <option value="<?= $id ?>" <?= $class_id == $id ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <select name="session_id">
                    <option value="">All Sessions</option>
                    <?php foreach ($session_options as $sess): ?>
                      <option value="<?= htmlspecialchars($sess) ?>" <?= $session_val == $sess ? 'selected' : '' ?>><?= htmlspecialchars($sess) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <select name="term">
                    <option value="">All Terms</option>
                    <?php foreach ($term_options as $t): ?>
                      <option value="<?= htmlspecialchars($t) ?>" <?= $term == $t ? 'selected' : '' ?>><?= htmlspecialchars($t) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <select name="subject_id">
                    <option value="">All Subjects</option>
                    <?php foreach ($subject_options as $id => $name): ?>
                      <option value="<?= $id ?>" <?= $subject_id == $id ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <select name="exam_id">
                    <option value="">All Exam Types</option>
                    <?php foreach ($exam_options as $id => $name): ?>
                      <option value="<?= $id ?>" <?= $exam_id == $id ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit"><i class="fa fa-search"></i> Filter</button>
                  <?php if ($_GET): ?>
                    <a href="score_report.php" class="btn btn-secondary" style="border-radius:20px;padding:6px 18px;font-size:15px;">Reset</a>
                  <?php endif; ?>
                </form>
                <!-- Printable Area -->
                <div id="printable-area">
                  <div class="report-title"><?php echo $app_name; ?> - Score Report</div>
                  <div class="report-meta">
                  Date: <?php echo date('d M Y'); ?>
                  </div>
                  <table class="table-report">
                  <thead>
                    <tr>
                    <th>#</th>
                    <th>Admission No</th>
                    <th>Full Name</th>
                    <th>Sex</th>
                    <th>Class</th>
                    <th>Session</th>
                    <th>Term</th>
                    <th>Subject</th>
                    <th>Exam Type</th>
                    <th>Test Score</th>
                    <th>Exam Score</th>
                    <th>Total Mark</th>
                    <th>Grade</th>
                    <th>Position in Subject</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  // Helper function to add ordinal suffix
                  function ordinal($number) {
                    $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
                    if (($number % 100) >= 11 && ($number % 100) <= 13)
                      return $number . 'th';
                    else
                      return $number . $ends[$number % 10];
                  }

                  $cnt = 1;
                  if (!empty($results)) {
                    foreach ($results as $row) {
                    ?>
                    <tr>
                      <td><?= $cnt++; ?></td>
                      <td><?= htmlspecialchars($row['admission_no']); ?></td>
                      <td><?= htmlspecialchars($row['fullname']); ?></td>
                      <td><?= htmlspecialchars($row['sex']); ?></td>
                      <td>
                        <?= htmlspecialchars($row['class_name']); ?>
                        <?php if (!empty($row['section_name'])): ?>
                          - <?= htmlspecialchars($row['section_name']); ?>
                        <?php endif; ?>
                      </td>
                      <td><?= htmlspecialchars($row['academic_session']); ?></td>
                      <td><?= htmlspecialchars($row['term']); ?></td>
                      <td><?= htmlspecialchars($row['subject_name']); ?></td>
                      <td><?= htmlspecialchars($row['exam_name']); ?></td>
                      <td><?= htmlspecialchars($row['test_score']); ?></td>
                      <td><?= htmlspecialchars($row['exam_score']); ?></td>
                      <td><?= htmlspecialchars($row['total_mark']); ?></td>
                      <td><?= htmlspecialchars($row['grade']); ?></td>
                      <td>
                      <?php
                        if (is_numeric($row['position_in_subject'])) {
                        echo ordinal($row['position_in_subject']);
                        } else {
                        echo htmlspecialchars($row['position_in_subject']);
                        }
                      ?>
                      </td>
                    </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                    <td colspan="15" class="text-center text-danger">No score found.</td>
                    </tr>
                    <?php
                  }
                  ?>
                  </tbody>
                  </table>
                </div>
                <!-- Print button -->
                <button class="print-btn" onclick="window.print(); return false;"><i class="fa fa-print"></i> Print Report</button>
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

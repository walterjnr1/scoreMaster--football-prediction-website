<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
  exit();
}

$student_id = intval($_GET['student_id']);
$subject_id = intval($_GET['subject_id']);

// Fetch student info
$stmt = $dbh->query("SELECT students.fullname, students.admission_no FROM students WHERE id = '$student_id' AND school_id = '$school_id'");
$student = $stmt->fetch();

// Fetch subject name
$stmt_subject = $dbh->query("SELECT name FROM subjects WHERE id = '$subject_id'");
$subject = $stmt_subject->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $app_name; ?> | All Scores</title>
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
          <div class="col-sm-6"><h1>All Scores for <?php echo htmlspecialchars($student['fullname']); ?> - <?php echo htmlspecialchars($subject['name']); ?></h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">All Scores</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Score Records</h3>
          </div>
          <?php if (!empty($permissions['score record']['read'])): ?>      
            <a href="score_record">
              <button class="btn btn-primary">Back to Score Record</button>
            </a>
            <?php endif; ?>

          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Academic Year</th>
                  <th>Term</th>
                  <th>Exam Type</th>
                  <th>Test Score</th>
                  <th>Exam Score</th>
                  <th>Total Mark</th>
                  <th>Grade</th>
                  <th>Position</th>
                </tr>
              </thead>
              <tbody>
                <?php
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

                $sql = "SELECT 
                          er.test_score,
                          er.exam_score,
                          er.total_mark,
                          g.grade,
                          er.position_in_subject,
                          asess.session,
                          asess.term,
                          ex.exam_name
                        FROM exam_results er
                        JOIN academic_session asess ON er.session_id = asess.id
                        JOIN grades g ON er.grade_id = g.id
                        JOIN exams ex ON er.exam_id = ex.id
                        WHERE er.student_id = ? AND er.subject_id = ? AND er.school_id = ?
                        ORDER BY asess.session DESC, asess.term DESC";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iii", $student_id, $subject_id, $_SESSION['school_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $cnt = 1;
                while ($row = $result->fetch_assoc()):
                ?>
                  <tr>
                    <td><?= $cnt++; ?></td>
                    <td><?= htmlspecialchars($row['session']); ?></td>
                    <td><?= htmlspecialchars($row['term']); ?></td>
                    <td><?= htmlspecialchars($row['exam_name']); ?></td>
                    <td><?= $row['test_score']; ?></td>
                    <td><?= $row['exam_score']; ?></td>
                    <td><?= $row['total_mark']; ?></td>
                    <td><?= $row['grade']; ?></td>
                    <td><?= ordinal_suffix($row['position_in_subject']); ?></td>
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

</div>
<?php include('partials/bottom-script.php'); ?>
</body>
</html>

<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

$id = $_GET['id'];
// Fetch existing score record
$stmt = $dbh->prepare("SELECT exam_results.*, students.fullname AS student_name, students.class_id, classes.name AS class_name, classes.section AS class_section, subjects.name AS subject_name, exams.exam_name AS exam_name, academic_session.session AS session, academic_session.term AS term, grades.grade AS grade FROM exam_results 
  JOIN students ON exam_results.student_id = students.id 
  JOIN classes ON students.class_id = classes.id 
  JOIN subjects ON exam_results.subject_id = subjects.id 
  JOIN exams ON exam_results.exam_id = exams.id 
  JOIN academic_session ON exam_results.session_id = academic_session.id 
  JOIN grades ON exam_results.grade_id = grades.id 
  WHERE exam_results.school_id = ? AND exam_results.id = ?");
$stmt->execute([$school_id, $id]);
$row_score = $stmt->fetch(PDO::FETCH_ASSOC);

// When editing
if (isset($_POST['btnedit'])) {
  $test_score = floatval($_POST['txttest_score']);
  $exam_score = floatval($_POST['txtexam_score']);
  $total_score = $test_score + $exam_score;

  // Determine grade based on total score
  $grade_stmt = $dbh->prepare("SELECT id FROM grades WHERE school_id = ? AND ? BETWEEN min_score AND max_score LIMIT 1");
  $grade_stmt->execute([$school_id, $total_score]);
  $grade_row = $grade_stmt->fetch(PDO::FETCH_ASSOC);
  $grade_id = $grade_row ? $grade_row['id'] : null;

  // Update the score and grade in exam_results
  $update = $dbh->prepare("UPDATE exam_results SET test_score = ?, exam_score = ?, grade_id = ? WHERE school_id=? and id = ?");
  $update->execute([$test_score, $exam_score, $grade_id, $school_id, $id]);

  // Recalculate subject positions
  $class_id = $row_score['class_id'];
  $subject_id = $row_score['subject_id'];
  $exam_id = $row_score['exam_id'];
  $session_id = $row_score['session_id'];

  // Fetch all students for the same subject/class/exam/session
  $students_stmt = $dbh->prepare("SELECT id, total_mark FROM exam_results WHERE school_id = ? AND class_id = ? AND subject_id = ? AND exam_id = ? AND session_id = ? ORDER BY total_mark DESC");
  $students_stmt->execute([$school_id, $class_id, $subject_id, $exam_id, $session_id]);

  $rank = 1;
  while ($row = $students_stmt->fetch(PDO::FETCH_ASSOC)) {
    $update_rank = $dbh->prepare("UPDATE exam_results SET position_in_subject = ? WHERE id = ?");
    $update_rank->execute([$rank, $row['id']]);
    $rank++;
  }

  // Activity log
  $operation = "Updated student score and grade on $current_date";
  log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);
  
  $operation .= " for student: " . $row_score['student_name'] . ", subject: " . $row_score['subject_name'] . ", class: " . $row_score['class_name'] . " " . $row_score['class_section'];
  header("Refresh: 2; URL=score_record");
  $_SESSION['success'] = "Score, grade updated, and positions recalculated successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $app_name; ?> | Edit Score</title>
  <?php include('partials/head.php'); ?>
  <script>
    function calculateTotal() {
      const test = parseFloat(document.getElementById("test_score").value) || 0;
      const exam = parseFloat(document.getElementById("exam_score").value) || 0;
      document.getElementById("total_mark").value = test + exam;
    }
  </script>
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
          <div class="col-sm-6"><h1>Edit Score</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Score</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <form action="" method="POST">
          <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Edit Score</h3></div>
            <div class="card-body">
              <div class="form-group">
              <label>Student Name</label>
              <input type="text" class="form-control" readonly value="<?= $row_score['student_name']; ?>">
              </div>
              <div class="form-group">
              <label>Class</label>
              <input type="text" class="form-control" readonly value="<?= $row_score['class_name'] . ' ' . $row_score['class_section']; ?>">
              </div>
              <div class="form-group">
              <label>Subject</label>
              <input type="text" class="form-control" readonly value="<?= $row_score['subject_name']; ?>">
              </div>
              <div class="form-group">
              <label>Session/Term</label>
              <input type="text" class="form-control" readonly value="<?= $row_score['session'] . '-' . $row_score['term']; ?>">
              </div>
              
              <div class="form-group">
              <label>Test Score</label>
              <input type="number" step="0.01" name="txttest_score" id="test_score" class="form-control" value="<?= $row_score['test_score']; ?>" oninput="validateScores(); calculateTotal()">
              </div>
              <div class="form-group">
              <label>Exam Score</label>
              <input type="number" step="0.01" name="txtexam_score" id="exam_score" class="form-control" value="<?= $row_score['exam_score']; ?>" oninput="validateScores(); calculateTotal()">
              </div>
              <div class="form-group">
              <label>Total Mark</label>
              <input type="text" id="total_mark" class="form-control" readonly>
              </div>
            </div>
     
            <div class="card-footer">
              <button type="submit" name="btnedit" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <?php include('partials/footer.php'); ?>
  </footer>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<?php include('partials/bottom-script.php'); ?>
<script>
  // Pre-calculate total on page load
  window.onload = calculateTotal;
</script>
</body>
</html>
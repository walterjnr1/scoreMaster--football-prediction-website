<?php 
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
    header("Location: ../Auth/user_login");
  //exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($app_name); ?> | Score Record</title>
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
          <div class="col-sm-6"><h1>Score Record</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Score Record</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h5>Table showing student scores by subject</h5>
            <?php if (!empty($permissions['result record']['create'])): ?>      
              <a href="start_upload_score">
                <button class="btn btn-primary">Start Uploading Result</button>
              </a>
            <?php endif; ?>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Student Name</th>
                  <th>Academic Year</th>
                  <th>Subject</th>
                  <th>Class</th>
                  <th>Total Mark(100%)</th>
                  <th>Grade</th>
                  <th>Exam Type</th>
                  <th>Position</th>
                  <th>Action</th>
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

              // Fetch all results for the school
              $sql = "SELECT 
                        er.id,
                        er.student_id,
                        er.subject_id, er.total_mark,
                        er.class_id,
                        er.session_id,
                        er.exam_id,
                        s.fullname AS student_name,
                        s.admission_no,
                        asess.session AS academic_year,
                        asess.term,
                        subj.name AS subject_name,
                        cls.name AS class_name,
                        cls.section AS class_section,
                        g.grade,
                        ex.exam_name
                      FROM exam_results er
                      JOIN students s ON er.student_id = s.id
                      JOIN academic_session asess ON er.session_id = asess.id
                      JOIN subjects subj ON er.subject_id = subj.id
                      JOIN classes cls ON er.class_id = cls.id
                      JOIN exams ex ON er.exam_id = ex.id
                      JOIN grades g ON er.grade_id = g.id
                      WHERE er.school_id = ?
                      ORDER BY er.subject_id, er.class_id, er.session_id, er.exam_id, er.total_mark DESC, er.id ASC";

              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $_SESSION['school_id']);
              $stmt->execute();
              $result = $stmt->get_result();

              // Group results for ranking
              $grouped = [];
              while ($row = $result->fetch_assoc()) {
                $groupKey = $row['subject_id'] . '_' . $row['class_id'] . '_' . $row['session_id'] . '_' . $row['exam_id'];
                $grouped[$groupKey][] = $row;
              }

              $cnt = 1;
              foreach ($grouped as $group) {
                $position = 1;
                $prev_mark = null;
                $same_rank_count = 0;
                foreach ($group as $idx => $row) {
                  if ($prev_mark !== null && $row['total_mark'] == $prev_mark) {
                    // Same mark as previous, same position
                    $same_rank_count++;
                  } else {
                    // New mark, increment position by number of same marks
                    $position += $same_rank_count;
                    $same_rank_count = 1;
                  }
                  $prev_mark = $row['total_mark'];
              ?>
                <tr>
                  <td><?= $cnt++; ?></td>
                  <td><?= htmlspecialchars($row['student_name']); ?></td>
                  <td><?= htmlspecialchars($row['academic_year'] . ' ' . $row['term']); ?></td>
                  <td><?= htmlspecialchars($row['subject_name']); ?></td>
                  <td><?= htmlspecialchars($row['class_name'] . ' ' . $row['class_section']); ?></td>
                  <td><?= htmlspecialchars($row['total_mark']); ?></td>
                  <td><?= htmlspecialchars($row['grade']); ?></td>
                  <td><?= htmlspecialchars($row['exam_name']); ?></td>
                  <td><?= ordinal_suffix($position); ?></td>
                  <td>
                    <?php if (!empty($permissions['score record']['delete'])): ?>      
                        <a href="delete_score?id=<?= $row['id']; ?>" onclick="return confirm('ARE YOU SURE YOU WISH TO DELETE THE SCORE FOR <?= htmlspecialchars($row['student_name']); ?> IN <?= htmlspecialchars($row['subject_name']); ?>?');">
                        <i class="fa fa-trash" title="Delete"></i>
                      </a>  
                    <?php endif; ?>
                    <?php if (!empty($permissions['score record']['update'])): ?>      
                      <a href="edit_score?id=<?= $row['id']; ?>">
                        <i class="fa fa-edit" title="Edit"></i>
                      </a>
                    <?php endif; ?>
                    <a href="view_all_score.php?student_id=<?= $row['student_id']; ?>&subject_id=<?= $row['subject_id']; ?>">
                      <i class="fa fa-eye" title="View All Scores for Subject"></i>
                    </a>
                  </td>
                </tr>
              <?php
                }
              }
              ?>
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

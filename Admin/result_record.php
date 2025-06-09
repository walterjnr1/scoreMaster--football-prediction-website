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
  <title><?= htmlspecialchars($app_name); ?> | Result Record</title>
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
          <div class="col-sm-6"><h1>Result Record</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active">Result Record</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h5>Table showing student results summary</h5>
            <?php if (!empty($permissions['upload scores']['create'])): ?>      
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
                  <th>Class</th>
                  <th>Session</th>
                  <th>Term</th>
                  <th>Exam Type</th>
                  <th>Total Marks</th>
                  <th>Average Marks</th>
                  <th>Overall Position</th>
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

              // Step 1: Get all grouped results
              $sql = "
                SELECT
                  er.student_id,
                  s.fullname AS student_name,
                  cls.name AS class_name,
                  cls.section AS class_section,
                  asess.session AS academic_year,
                  asess.term,
                  ex.exam_name,
                  SUM(er.total_mark) AS total_marks,
                  AVG(er.total_mark) AS average_marks,
                  er.class_id,
                  er.session_id,
                  er.exam_id
                FROM exam_results er
                JOIN students s ON er.student_id = s.id
                JOIN classes cls ON er.class_id = cls.id
                JOIN academic_session asess ON er.session_id = asess.id
                JOIN exams ex ON er.exam_id = ex.id
                WHERE er.school_id = ?
                GROUP BY er.student_id, er.class_id, er.session_id, er.exam_id
                ORDER BY er.class_id, er.session_id, er.exam_id, total_marks DESC
              ";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $_SESSION['school_id']);
              $stmt->execute();
              $result = $stmt->get_result();

              // Step 2: Process results by group to assign ranks
              $results = [];
              while ($row = $result->fetch_assoc()) {
                  $key = $row['class_id'] . '_' . $row['session_id'] . '_' . $row['exam_id'];
                  $results[$key][] = $row;
              }

              $cnt = 1;
              foreach ($results as $group):
                usort($group, fn($a, $b) => $b['total_marks'] <=> $a['total_marks']);
                $rank = 1;
                foreach ($group as $row):
              ?>
                <tr>
                  <td><?= $cnt++; ?></td>
                  <td><?= htmlspecialchars($row['student_name']); ?></td>
                  <td><?= htmlspecialchars($row['class_name'] . ' ' . $row['class_section']); ?></td>
                  <td><?= htmlspecialchars($row['academic_year']); ?></td>
                  <td><?= htmlspecialchars($row['term']); ?></td>
                  <td><?= htmlspecialchars($row['exam_name']); ?></td>
                  <td><?= htmlspecialchars($row['total_marks']); ?></td>
                  <td><?= htmlspecialchars(number_format($row['average_marks'], 2)); ?></td>
                  <td><?= ordinal_suffix($rank++); ?></td>
                  <td>
                    <?php if (!empty($permissions['result record']['delete'])): ?>      
                      <a href="delete_result.php?id=<?= $row['id']; ?>&student_id=<?= $row['student_id']; ?>&session_id=<?= $row['session_id']; ?>&exam_id=<?= $row['exam_id']; ?>&class_id=<?= $row['class_id']; ?>" onclick="return confirm('Are you sure you wish to delete all subject results for <?= htmlspecialchars($row['student_name']); ?>?');">
                        <i class="fa fa-trash" title="Delete"></i>
                      </a>  
                <?php else: ?>
                        <i class="fa fa-trash text-muted" aria-hidden="true" title="Delete Result"></i>
                      <?php endif; ?>
                                      </td>
                </tr>
              <?php endforeach; endforeach; ?>
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

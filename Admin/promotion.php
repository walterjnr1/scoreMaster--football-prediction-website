<?php 
//session_start();
include('../inc/config.php');

// Ensure required session variables are set
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
  <title><?= htmlspecialchars($app_name); ?> | Promotion </title>
  <?php include('partials/head.php'); ?>
  <style type="text/css">
<!--
.style1 {color: #FF0000}
-->
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
      <div class="col-sm-6"><h1>Promotion </h1></div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index">Home</a></li>
        <li class="breadcrumb-item active">Promotion </li>
      </ol>
      </div>
    </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
    <h5>Table showing student Result </h5>
    <h6 class="style1">Only students with Total average above 39% will be marked as Eligibe ,displayed and promoted</h6>
    </div>

    <div class="card-body">
    <?php
    // Helper function for ordinal suffix
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

    $promotion_message = '';

    // Get current session's term
    $term = '';
    $term_stmt = $conn->prepare("SELECT term FROM academic_session WHERE school_id=? and id = ?");
    $term_stmt->bind_param("ii",$school_id, $session_id);
    $term_stmt->execute();
    $term_stmt->bind_result($term);
    $term_stmt->fetch();
    $term_stmt->close();

    // Only allow promotion in 3rd term
    $promotion_allowed = (strtolower(trim($term)) === '3rd' || trim($term) === '3');

    // Promotion logic
    $promotion_done = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['promote_all'])) {
      if (!$promotion_allowed) {
        $promotion_message .= "<div class='alert alert-danger'>Promotion only works on 3rd term.</div>";
      } else {
        // Get students eligible for promotion (not already promoted, avg > 39, only for current session)
        $sql = "
        SELECT
        er.student_id,
        er.class_id,
        er.session_id,
        er.exam_id,
        AVG(er.total_mark) AS average_marks
        FROM exam_results er
        WHERE er.school_id = ? AND er.session_id = ?
        GROUP BY er.student_id, er.class_id, er.session_id, er.exam_id
        HAVING average_marks > 39
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $school_id, $session_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $promoted_count = 0;
        $already_promoted_count = 0;
        while ($row = $result->fetch_assoc()) {
          // Check if already promoted
          $check = $conn->prepare("SELECT id FROM promotions WHERE school_id=? AND student_id=? AND from_class_id=? AND session_id=?");
          $check->bind_param("iiii", $school_id, $row['student_id'], $row['class_id'], $row['session_id']);
          $check->execute();
          $check->store_result();
          if ($check->num_rows > 0) {
            $already_promoted_count++;
            $check->close();
            continue;
          }
          $check->close();

          // Fetch next_class field from classes table for this class_id and school_id
          $next_class_field = '';
          $get_next = $conn->prepare("SELECT next_class FROM classes WHERE school_id=? AND id = ?");
          $get_next->bind_param("ii", $school_id, $row['class_id']);
          $get_next->execute();
          $get_next->bind_result($next_class_field);
          $get_next->fetch();
          $get_next->close();

          if ($next_class_field) {
            $next_class_name = substr($next_class_field, 0, -1);
            $next_class_section = substr($next_class_field, -1);

            // Get id of next class by name and section
            $new_class_id = null;
            $get_new_class = $conn->prepare("SELECT id FROM classes WHERE school_id=? AND name = ? AND section = ?");
            $get_new_class->bind_param("iss", $school_id, $next_class_name, $next_class_section);
            $get_new_class->execute();
            $get_new_class->bind_result($new_class_id);
            $get_new_class->fetch();
            $get_new_class->close();

            if ($new_class_id) {
              // Promote student (insert into promotions)
              $insert = $conn->prepare("INSERT INTO promotions (school_id,student_id, from_class_id, to_class_id, session_id) VALUES (?,?,?,?,?)");
              $insert->bind_param("iiiii", $school_id, $row['student_id'], $row['class_id'], $new_class_id, $row['session_id']);
              $insert->execute();
              $insert->close();

              // Update student's class_id to next_class (from classes table)
              $update = $conn->prepare("UPDATE students SET class_id = ? WHERE school_id = ? AND id = ?");
              $update->bind_param("iii", $new_class_id, $school_id, $row['student_id']);
              $update->execute();
              $update->close();

              $promoted_count++;
            }
          }
        }
        if ($promoted_count > 0) {
          $promotion_message .= "<div class='alert alert-success'>{$promoted_count} student(s) promoted successfully.</div>";
        }
        if ($already_promoted_count > 0) {
          $promotion_message .= "<div class='alert alert-warning'>{$already_promoted_count} student(s) were already promoted and skipped.</div>";
        }
        if ($promoted_count == 0 && $already_promoted_count == 0) {
          $promotion_message .= "<div class='alert alert-info'>Students not available for promotion.</div>";
        }
        $promotion_done = true;
      }
    }

    // Only display results if promotion has not been done in this request
    if (!$promotion_done) {
      // Step 1: Get all grouped results (not already promoted, avg > 39, only for current session)
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
      WHERE er.school_id = ? AND er.session_id = ?
      GROUP BY er.student_id, er.class_id, er.session_id, er.exam_id
      HAVING average_marks > 39
      ORDER BY er.class_id, er.session_id, er.exam_id, total_marks DESC
      ";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $school_id, $session_id);
      $stmt->execute();
      $result = $stmt->get_result();

      // Step 2: Filter out already promoted students
      $results = [];
      while ($row = $result->fetch_assoc()) {
        // Check if already promoted
        $check = $conn->prepare("SELECT id FROM promotions WHERE school_id=? AND student_id=? AND from_class_id=? AND session_id=?");
        $check->bind_param("iiii", $school_id, $row['student_id'], $row['class_id'], $row['session_id']);
        $check->execute();
        $check->store_result();
        if ($check->num_rows == 0) {
          $row['already_promoted'] = false;
          $key = $row['class_id'] . '_' . $row['session_id'] . '_' . $row['exam_id'];
          $results[$key][] = $row;
        } else {
          // If already promoted, add to results with flag
          $row['already_promoted'] = true;
          $key = $row['class_id'] . '_' . $row['session_id'] . '_' . $row['exam_id'];
          $results[$key][] = $row;
        }
        $check->close();
      }
    }
    ?>

    <?php
    // Only show alert if no students available for promotion or not 3rd term
    if (!$promotion_allowed) {
      echo "<div class='alert alert-warning'>Promotion only works on 3rd term.</div>";
    } elseif (!$promotion_done && count($results) === 0) {
      echo "<div class='alert alert-info'>Students result not available for promotion.</div>";
    }
    ?>

    <?= $promotion_message ?>

    <?php if ($promotion_allowed && !$promotion_done && count($results) > 0): ?>
    <form method="post">
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
    <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
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
      <?php if ($row['already_promoted']): ?>
      <span class="badge badge-warning">Already Promoted</span>
      <?php else: ?>
      <span class="badge badge-success">Eligible</span>
      <?php endif; ?>
    </td>
    </tr>
    <?php endforeach; endforeach; ?>
    </tbody>
    </table>
    <button type="submit" name="promote_all" class="btn btn-success mt-3"
    onclick="return confirm('Are you sure you want to promote all eligible students? This action cannot be undone.');"
    <?= !$promotion_allowed ? 'disabled' : '' ?>>
    Promote All
    </button>
    </form>
    <?php endif; ?>
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
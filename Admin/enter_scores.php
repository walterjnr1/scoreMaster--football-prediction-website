<?php
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
    header("Location: ../Auth/user_login");
}

$class_id   = $_GET['class_id'] ?? '';
$subject_id = $_GET['subject_id'] ?? '';
$exam_id    = $_GET['exam_type'] ?? '';
$session_id = $_GET['session_term_id'] ?? '';

// Fetch class & subject names
$classStmt = $dbh->prepare("SELECT name, section FROM classes WHERE id = ? AND school_id = ?");
$classStmt->execute([$class_id, $school_id]);
$class = $classStmt->fetch();

$subjStmt = $dbh->prepare("SELECT name FROM subjects WHERE id = ? AND school_id = ?");
$subjStmt->execute([$subject_id, $school_id]);
$subject = $subjStmt->fetch();

if (isset($_POST['btnadd'])) {
    $test_scores = $_POST['test_scores'] ?? [];
    $exam_scores = $_POST['exam_scores'] ?? [];

    $checkStmt = $dbh->prepare("SELECT COUNT(*) FROM exam_results 
        WHERE student_id = ? AND subject_id = ? AND exam_id = ? AND session_id = ? AND school_id = ?");

    $insertStmt = $dbh->prepare("INSERT INTO exam_results 
        (school_id, session_id, student_id, subject_id, exam_id, test_score, exam_score, class_id, position_in_subject, grade_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL)");

    $scoresAdded = false;
    foreach ($test_scores as $student_id => $test_score) {
        $exam_score = $exam_scores[$student_id] ?? 0;
        $total_mark = $test_score + $exam_score;

        // Check for duplicate
        $checkStmt->execute([$student_id, $subject_id, $exam_id, $session_id, $school_id]);
        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            $_SESSION['error'] = "Scores for some students already exist for this subject and session.";
            continue;
        }

        $insertStmt->execute([
            $school_id, $session_id, $student_id, $subject_id, $exam_id,
            $test_score, $exam_score, $class_id
        ]);
        $scoresAdded = true;
    }

    if ($scoresAdded) {
        // Calculate and update subject position
        $dbh->exec("SET @rank := 0;");
        $positionStmt = $dbh->prepare("
            UPDATE exam_results er
            JOIN (
                SELECT student_id, @rank := @rank + 1 AS position
                FROM (
                    SELECT student_id, total_mark
                    FROM exam_results
                    WHERE class_id = ? AND subject_id = ? AND exam_id = ? AND session_id = ? AND school_id = ?
                    ORDER BY total_mark DESC
                ) ranked
            ) sub ON er.student_id = sub.student_id
            SET er.position_in_subject = sub.position
            WHERE er.class_id = ? AND er.subject_id = ? AND er.exam_id = ? AND er.session_id = ? AND er.school_id = ?
        ");
        $positionStmt->execute([
            $class_id, $subject_id, $exam_id, $session_id, $school_id,
            $class_id, $subject_id, $exam_id, $session_id, $school_id
        ]);

        // Assign grades
        $gradeStmt = $dbh->prepare("
            UPDATE exam_results er
            JOIN grades g ON er.total_mark BETWEEN g.min_score AND g.max_score AND g.school_id = er.school_id
            SET er.grade_id = g.id
            WHERE er.class_id = ? AND er.subject_id = ? AND er.exam_id = ? AND er.session_id = ? AND er.school_id = ?
        ");
        $gradeStmt->execute([$class_id, $subject_id, $exam_id, $session_id, $school_id]);

        // Log activity
        $operation = "Entered student scores for {$class['name']} {$class['section']} - {$subject['name']}";
        log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

        $_SESSION['success'] = "Scores, positions, and grades successfully recorded.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enter Scores | <?= htmlspecialchars($app_name) ?></title>
    <?php include('partials/head.php'); ?>
</head>
<body>
<?php include('partials/navbar.php'); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include('partials/sidebar.php'); ?>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Enter Scores for <?= htmlspecialchars($term) ?> Term
            <small><?= htmlspecialchars($class['name'] . ' ' . $class['section']) ?> / <?= htmlspecialchars($subject['name']) ?></small>        </h1>
        <p>&nbsp;</p>
        <a href="start_upload_score">
                <button class="btn btn-primary"> Start Uploading Result</button>
      </a>
    </section>
    <section class="content">
        <p>&nbsp;</p>
        <form method="POST">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Test (30%)</th>
                            <th>Exam (70%)</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stmt = $dbh->prepare("
                            SELECT s.id, s.fullname
                            FROM students s
                            WHERE s.class_id = ? AND s.school_id = ?
                              AND NOT EXISTS (
                                  SELECT 1 FROM exam_results er
                                  WHERE er.student_id = s.id
                                    AND er.subject_id = ?
                                    AND er.exam_id = ?
                                    AND er.session_id = ?
                                    AND er.school_id = ?
                              )
                        ");
                        $stmt->execute([$class_id, $school_id, $subject_id, $exam_id, $session_id, $school_id]);
                        $students = $stmt->fetchAll();
                        $i = 1;
                        foreach ($students as $student):
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($student['fullname']) ?></td>
                                <td>
                                    <input type="number" name="test_scores[<?= $student['id'] ?>]" class="form-control test-score" min="0" max="30">
                                </td>
                                <td>
                                    <input type="number" name="exam_scores[<?= $student['id'] ?>]" class="form-control exam-score" min="0" max="70" >
                                </td>
                                <td>
                                    <input type="text" class="form-control total-score" readonly>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (count($students) > 0): ?>
                        <div class="text-right mt-3">
                            <button name="btnadd" class="btn btn-primary">Submit Scores</button>
                        </div>
                    <?php else: ?>
                        <p class="text-center mt-3" style="color: red;">No student records found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </form>
  </section>
</div>

<?php include('partials/footer.php'); ?>
<?php include('partials/bottom-script.php'); ?>


</body>
</html>
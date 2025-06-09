<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
  exit();
}

$student_id = $_GET['student_id'];
$session_id = $_GET['session_id'];
$exam_id    = $_GET['exam_id'];
$class_id   = $_GET['class_id'];

$stmt = $conn->prepare("DELETE FROM exam_results WHERE school_id = ? AND student_id = ? AND class_id = ? AND session_id = ? AND exam_id = ?");
$stmt->bind_param("iiiii", $school_id, $student_id, $class_id, $session_id, $exam_id);

if ($stmt->execute()) {
    $operation = "deleted all scores for student $student_id in exam $exam_id, class $class_id, session $session_id, school $school_id on $current_date";
    log_activity($conn, $school_id, $user_id, $role, $operation, $ip_address);

    $_SESSION['success'] = "All scores deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete scores.";
}

header("Location: result_record");
//exit();
?>

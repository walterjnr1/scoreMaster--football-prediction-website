<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
    header("Location: ../Auth/user_login");
    //exit;
}

$student_id = $_GET['student_id'];
$session_id = $_GET['session_id'];
$exam_id    = $_GET['exam_id'];
$class_id   = $_GET['class_id'];

$stmt = $conn->prepare("DELETE FROM exam_results WHERE student_id = ? AND session_id = ? AND exam_id = ? AND class_id = ?");
$stmt->bind_param("iiii", $student_id, $session_id, $exam_id, $class_id);

if ($stmt->execute()) {
                //activity log
              $operation = "deleted result on $current_date";
              log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

    $_SESSION['success'] = "Result deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete result.";
}

header("Location: result_record");
//exit;
?>
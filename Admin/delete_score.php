<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

$id= $_GET['id'];
$sql = "DELETE FROM exam_results WHERE id=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

      //activity log
      $operation = "deleted scores on $current_date";
      log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

header("Location: score_record");
 ?>

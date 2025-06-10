<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../login");
}

$id= $_GET['id'];
$sql = "DELETE FROM permissions WHERE id=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

      //activity log
      $operation = "deleted permission on $current_date";
      log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

header("Location: permission_record");
 ?>

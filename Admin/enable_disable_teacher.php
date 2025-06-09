<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

	 // for Block teachr
if(isset($_GET['did']))
{
$did=intval($_GET['did']);

mysqli_query($conn,"update users set status='0' where school_id='$school_id' and id='$did'");

 //activity log
 $operation = "disable teacher on $current_date";
 log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);
 header("location: teacher_record");
}

// for unBlock teacher
if(isset($_GET['eid']))
{
$eid=intval($_GET['eid']);

mysqli_query($conn,"update users set status='1' where  school_id='$school_id' and id='$eid'");

 //activity log
 $operation = "enable teacher on $current_date";
 log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);
header("location: teacher_record");
}

?>

<?php
include('../inc/config.php');
if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
}

	 // for Block admin
if(isset($_GET['did']))
{
$did=intval($_GET['did']);

mysqli_query($conn,"update users set status='0' where id='$did'");

 //activity log
 $operation = "disable user on $current_date";
 log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

header("location: user_record");
}

// for unBlock admin
if(isset($_GET['eid']))
{
$eid=intval($_GET['eid']);

mysqli_query($conn,"update users set status='1' where id='$eid'");

 //activity log
 $operation = "disable user on $current_date";
 log_activity($conn, $school_id,$user_id, $operation, $ip_address);


header("location: user_record");
}

?>

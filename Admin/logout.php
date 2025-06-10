<?php
include('../inc/config.php'); 
if (empty($_SESSION['user_id'])) {
  header("Location: ../login");
}

//Automatic logout
$t=time();
if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 3600)) {

	//session_destroy();
   // session_unset();
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Sorry , You have been Logout because of inactivity. Try Again');
    window.location.href='../Auth/user_login';
    </script>");
	}else {
    $_SESSION['logged'] = time();
}



  // Initialize variables from session or set default values
  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
  $school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : null;
  $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
  $ip_address = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
  $current_date = date('Y-m-d H:i:s');

  //activity log
  $operation = "logged out on $current_date";
  log_activity($conn, $school_id, $user_id, $role, $operation, $ip_address);
  session_destroy(); //destroy the session

header("Location: ../Auth/user_login");

?>

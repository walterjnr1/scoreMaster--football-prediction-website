<?php 
session_start();
error_reporting(1);
include('database/connect.php'); 
include('database/connect2.php'); 

//set time
date_default_timezone_set('Africa/lagos');
$current_date = date('Y-m-d H:i:s');

// Define the current month and year
$current_month = date('m');
$current_year = date('Y');

$app_name = 'ScoreMaster';
$app_logo = 'uploadImage/Logo/gradeplus.jpeg';
$app_email = 'support@scoremaster.com';


//website data
$stmt = $dbh->query("SELECT * FROM website_settings");
$row_website = $stmt->fetch();

//fetch user data
$user_id = $_SESSION["user_id"];
$stmt = $dbh->query("SELECT * FROM users where id='$user_id'");
$row_user = $stmt->fetch();
$role = $row_user['role'];
?>
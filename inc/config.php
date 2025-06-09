<?php 
session_start();
error_reporting(1);
include('../database/connect.php'); 
include('../database/connect2.php'); 
include('activity_log_function.php'); 

//set time
date_default_timezone_set('Africa/lagos');
$current_date = date('Y-m-d H:i:s');

// Define the current month and year
$current_month = date('m');
$current_year = date('Y');


$app_name = 'ScoreMaster';
$app_logo = 'uploadImage/Logo/gradeplus.jpeg';
$app_email = 'support@scoremaster.com';

//school data
$school_id = $_SESSION["school_id"];
$stmt = $dbh->query("SELECT * FROM schools where id='$school_id'");
$row_school = $stmt->fetch();

//fetch user data
$user_id = $_SESSION["user_id"];
$stmt = $dbh->query("SELECT * FROM users where id='$user_id' and school_id='$school_id'");
$row_user = $stmt->fetch();
$role = $row_user['role'];

//fetch student data
$student_id = $_SESSION["student_id"];
$stmt = $dbh->query("SELECT s.*, c.name AS class,c.id AS class_id, c.section AS section FROM students s LEFT JOIN classes c ON s.class_id = c.id
WHERE s.id = '$student_id' AND s.school_id = '$school_id' ");
$row_student = $stmt->fetch();
$fullname = $row_student['fullname'];

//fetch student login details
$stmt = $dbh->query("SELECT * FROM student_login_logs where student_id='$student_id' ORDER BY login_at DESC LIMIT 1");
$row_login = $stmt->fetch();


//fetch current session
$stmt = $dbh->query("SELECT * FROM academic_session where school_id='$school_id' and status='1'");
$row_session = $stmt->fetch();

//no of students
$stmt = $dbh->query("SELECT COUNT(*) as total FROM students where school_id='$school_id'");
$no_students = $stmt->fetch();

//no of students in a roll/class
$class_id = $_SESSION["class_id"];
$stmt = $dbh->query("SELECT COUNT(*) as number_on_roll FROM students where class_id='$class_id' and school_id='$school_id'");
$number_on_roll = $stmt->fetch();

//no of students in the system
$stmt = $dbh->query("SELECT COUNT(*) as total FROM students ");
$total_students = $stmt->fetch();

//no of schools in the system
$stmt = $dbh->query("SELECT COUNT(*) as total FROM schools");
$total_schools = $stmt->fetch();


//no of teachers
$stmt = $dbh->query("SELECT COUNT(*) as total FROM users where school_id='$school_id' and role ='Teacher'");
$no_teachers = $stmt->fetch();

//no of class
$stmt = $dbh->query("SELECT COUNT(*) as total FROM classes WHERE school_id='$school_id'");
$no_classes = $stmt->fetch();

//no of subject
$stmt = $dbh->query("SELECT COUNT(*) as total FROM subjects WHERE school_id='$school_id'");
$no_subject = $stmt->fetch();

// fetch total amount paid from payments table
$stmt = $dbh->query("SELECT SUM(amount) as total_paid FROM payments WHERE school_id='$school_id'");
$total_paid = $stmt->fetch();


//no of class
$stmt = $dbh->query("SELECT COUNT(*) as total FROM classes WHERE school_id='$school_id'");
$no_classes = $stmt->fetch();

$owner_id = $_SESSION["owner_id"];
$admission_no = $_SESSION["admission_no"];
$session_id= $row_session['id'];
// Fetch SMS balance from the API

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://sms.kivalosolutions.com/sms/api?action=check-balance&api_key=SWxHRXVSZUNVdE9xUkROWWJRc1E&response=json',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json'
    ),
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
    //echo "cURL Error: " . curl_error($curl);
    $response_data = null;
} else {
    $response_data = json_decode($response, true);
}

curl_close($curl);

if ($response_data && isset($response_data['balance'])) {
    $sms_balance = number_format((float)$response_data['balance'], 2, '.', ',');
} else {
    //echo "Unable to fetch SMS balance or invalid API response.";
   // $_SESSION['error'] ="Unable to fetch SMS balance or invalid API response.";
}

?>
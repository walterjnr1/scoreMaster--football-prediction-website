<?php
function log_activity($conn, $school_id,$user_id, $role,$operation) {
   
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $stmt = $conn->prepare("INSERT INTO activity_logs (school_id,user_id,role, operation, ip_address) VALUES (?, ?,?,? ,?)");
    $stmt->bind_param("sssss", $school_id, $user_id, $role, $operation, $ip_address);
    $stmt->execute();
    $stmt->close();
    
}
?>
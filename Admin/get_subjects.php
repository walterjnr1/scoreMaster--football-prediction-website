<?php

include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  http_response_code(403);
  echo json_encode([]);
 // exit;
}

$class_id = intval($_GET['class_id'] ?? 0);
$user_id  = intval($_SESSION['user_id'] ?? 0); // Ensure $user_id is set
$school_id = intval($_SESSION['school_id'] ?? 0); // Ensure $school_id is set

header('Content-Type: application/json');

if ($class_id === 0 || $user_id === 0 || $school_id === 0) {
  echo json_encode([]);
  //exit;
}

// Fetch subjects assigned to this teacher in that class
$stmt = $dbh->prepare("
  SELECT s.id, s.name
  FROM subjects s
  JOIN subject_teacher st
    ON st.subject_id = s.id
   WHERE st.user_id = :uid
   AND st.school_id = :sid
   AND st.class_id  = :cid
   ORDER BY s.name
");
$stmt->execute([
  ':uid' => $user_id,
  ':sid' => $school_id,
  ':cid' => $class_id
]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
<?php
require_once 'database.php';

$query = "SELECT * FROM email_log ORDER BY email_date DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($logs);
?>

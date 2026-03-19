<?php
require 'db.php';
$stmt = $conn->query("SELECT username, xp FROM users ORDER BY xp DESC LIMIT 5");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>

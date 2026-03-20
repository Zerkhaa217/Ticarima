<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
// Sabotaj yapınca karma düşer, yatırım yapınca artar
$stmt = $conn->query("SELECT karma FROM users WHERE id = $userId");
echo json_encode(["karma" => $stmt->fetchColumn()]);
?>

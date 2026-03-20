<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];

// Check mission status
$stmt = $conn->prepare("SELECT * FROM missions WHERE user_id = ? AND status = 'active'");
$stmt->execute([$userId]);
$missions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["missions" => $missions]);
?>

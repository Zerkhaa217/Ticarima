<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$cost = 5000; // Şube açma maliyeti

$stmt = $conn->prepare("UPDATE users SET cash = cash - ?, branches = branches + 1 WHERE id = ?");
$stmt->execute([$cost, $userId]);
echo json_encode(["status" => "branch_opened"]);
?>

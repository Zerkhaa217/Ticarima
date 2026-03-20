<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$cost = 5000; 

$stmt = $conn->prepare("UPDATE users SET cash = cash - ?, tech_level = tech_level + 1 WHERE id = ? AND cash >= ?");
$stmt->execute([$cost, $userId, $cost]);
echo json_encode(["status" => "unlocked"]);
?>

<?php
require 'db.php';
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$userId = $_SESSION['user_id'];
$cost = 1000; // İşe alım maliyeti

$stmt = $conn->prepare("UPDATE users SET cash = cash - ?, workers = workers + 1 WHERE id = ?");
$stmt->execute([$cost, $userId]);
echo json_encode(["status" => "hired"]);
?>

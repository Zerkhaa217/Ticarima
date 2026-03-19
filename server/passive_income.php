<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT workers FROM users WHERE id = ?");
$stmt->execute([$userId]);
$workers = $stmt->fetchColumn();

$income = $workers * 5; // Her işçi saniyede 5 TL pasif gelir üretir (simülasyon)
$conn->prepare("UPDATE users SET cash = cash + ? WHERE id = ?")->execute([$income, $userId]);
echo json_encode(["status" => "collected", "amount" => $income]);
?>

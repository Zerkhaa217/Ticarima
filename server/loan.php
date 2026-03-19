<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$amount = 5000;
$interest = 0.20; // %20 faiz

$stmt = $conn->prepare("UPDATE users SET cash = cash + ?, debt = debt + (? * (1 + ?)) WHERE id = ?");
$stmt->execute([$amount, $amount, $interest, $userId]);
echo json_encode(["status" => "loan_taken"]);
?>

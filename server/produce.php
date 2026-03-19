<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT level FROM factories WHERE user_id = ?");
$stmt->execute([$userId]);
$level = $stmt->fetchColumn();
$output = 1 + $level; // Level arttıkça daha çok üretim
$conn->prepare("UPDATE inventory SET quantity = quantity + ? WHERE user_id = ? AND item_name = 'Product1'")->execute([$output, $userId]);
echo json_encode(["status" => "produced", "amount" => $output]);
?>

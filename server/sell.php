<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$price = 200;
$tax = $price * 0.15; // %15 Vergi

$stmt = $conn->prepare("UPDATE inventory SET quantity = quantity - 1 WHERE item_name = 'Product1'");
$stmt->execute();
$stmt = $conn->prepare("UPDATE users SET cash = cash + ? WHERE id = ?");
$stmt->execute([($price - $tax), $userId]);
echo json_encode(["status" => "sold", "tax" => $tax]);
?>

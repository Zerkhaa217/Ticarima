<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$amount = $data['amount'];

$stmt = $conn->prepare("UPDATE users SET cash = cash - ?, savings = savings + ? WHERE id = ?");
$stmt->execute([$amount, $amount, $userId]);
echo json_encode(["status" => "deposited"]);
?>

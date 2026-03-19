<?php
require 'db.php';
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$userId = $_SESSION['user_id'];
$action = $data['action'];
$companyId = $data['companyId'];
$qty = $data['quantity'];

if ($action == 'BUY') {
    $stmt = $conn->prepare("UPDATE users SET cash = cash - (SELECT price * ? FROM companies WHERE id = ?) WHERE id = ?");
    $stmt->execute([$qty, $companyId, $userId]);
    $stmt = $conn->prepare("INSERT INTO portfolio (user_id, company_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
    $stmt->execute([$userId, $companyId, $qty, $qty]);
    echo json_encode(["status" => "success"]);
} elseif ($action == 'SELL') {
    $stmt = $conn->prepare("UPDATE users SET cash = cash + (SELECT price * ? FROM companies WHERE id = ?) WHERE id = ?");
    $stmt->execute([$qty, $companyId, $userId]);
    $stmt = $conn->prepare("UPDATE portfolio SET quantity = quantity - ? WHERE user_id = ? AND company_id = ?");
    $stmt->execute([$qty, $userId, $companyId]);
    echo json_encode(["status" => "success"]);
}
?>

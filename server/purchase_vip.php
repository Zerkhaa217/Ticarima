<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$tier = $data['tier']; // 1, 2, 3

$prices = [1 => 100, 2 => 500, 3 => 2000];
$cost = $prices[$tier];

$stmt = $conn->prepare("UPDATE users SET real_money = real_money - ?, vip_level = ? WHERE id = ? AND real_money >= ?");
$stmt->execute([$cost, $tier, $userId, $cost]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["status" => "success", "msg" => "VIP Tier $tier aktif!"]);
} else {
    echo json_encode(["status" => "error", "msg" => "Yetersiz bakiye!"]);
}
?>

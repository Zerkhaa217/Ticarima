<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$cost = 50000; // Premium bedeli

$stmt = $conn->prepare("UPDATE users SET cash = cash - ?, is_premium = 1 WHERE id = ? AND cash >= ?");
$stmt->execute([$cost, $userId, $cost]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["status" => "success", "msg" => "VIP Üyelik Aktif! Artık vergi yok, üretim 2x!"]);
} else {
    echo json_encode(["status" => "error", "msg" => "Yetersiz bakiye!"]);
}
?>

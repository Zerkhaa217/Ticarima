<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$sector = $data['sector'];
$cost = 5000; // Manipülasyon maliyeti

$stmt = $conn->prepare("UPDATE users SET cash = cash - ? WHERE id = ? AND cash >= ?");
$stmt->execute([$cost, $userId, $cost]);

if ($stmt->rowCount() > 0) {
    // Sektördeki şirket fiyatlarını düşür/yükselt
    $stmt = $conn->prepare("UPDATE companies SET price = price * 0.8 WHERE sector = ?");
    $stmt->execute([$sector]);
    echo json_encode(["status" => "manipulated"]);
} else {
    echo json_encode(["status" => "error", "msg" => "Yetersiz bakiye"]);
}
?>

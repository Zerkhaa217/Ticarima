<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$targetCompanyId = $data['companyId'];
$cost = 2000; // Sabotaj maliyeti

$stmt = $conn->prepare("UPDATE users SET cash = cash - ?, prestige = prestige + 5 WHERE id = ? AND cash >= ?");
$stmt->execute([$cost, $userId, $cost]);

if ($stmt->rowCount() > 0) {
    // Şirket fiyatını %10 çökert
    $conn->prepare("UPDATE companies SET price = price * 0.9 WHERE id = ?")->execute([$targetCompanyId]);
    echo json_encode(["status" => "sabotaged"]);
} else {
    echo json_encode(["status" => "error", "msg" => "Yetersiz bakiye"]);
}
?>

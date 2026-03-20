<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];

// Challenge: Toplam kazanç 10.000 TL ise "Milyoner" rozeti
$stmt = $conn->prepare("SELECT cash FROM users WHERE id = ?");
$stmt->execute([$userId]);
$cash = $stmt->fetchColumn();

if ($cash >= 10000) {
    $conn->prepare("UPDATE users SET badges = CONCAT(badges, ', Milyoner') WHERE id = ?")->execute([$userId]);
    echo json_encode(["badge" => "Milyoner"]);
} else {
    echo json_encode(["status" => "keep_grinding"]);
}
?>

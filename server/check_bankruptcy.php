<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT cash FROM users WHERE id = ?");
$stmt->execute([$userId]);
$cash = $stmt->fetchColumn();

if ($cash < 0) {
    echo json_encode(["status" => "bankrupt"]);
} else {
    echo json_encode(["status" => "ok"]);
}
?>

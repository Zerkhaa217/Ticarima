<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];

// Check for "Milyoner" and "Saboteur" badges
$stmt = $conn->prepare("SELECT cash, prestige FROM users WHERE id = ?");
$stmt->execute([$userId]);
$stats = $stmt->fetch();

$newBadges = [];
if ($stats['cash'] > 1000000) $newBadges[] = "Milyoner";
if ($stats['prestige'] > 100) $newBadges[] = "Sabotaj Ustası";

echo json_encode(["badges" => $newBadges]);
?>

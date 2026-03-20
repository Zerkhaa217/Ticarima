<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("UPDATE users SET cash = cash + 500, last_login = NOW() WHERE id = ?");
$stmt->execute([$userId]);
echo json_encode(["status" => "rewarded"]);
?>

<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("UPDATE factories SET level = level + 1 WHERE user_id = ?");
$stmt->execute([$userId]);
echo json_encode(["status" => "upgraded"]);
?>

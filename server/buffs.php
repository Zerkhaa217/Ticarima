<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];

// Buff: Üretim hızını artır
$conn->prepare("UPDATE users SET active_buff = 'SpeedBoost' WHERE id = ?")->execute([$userId]);
echo json_encode(["status" => "buff_active"]);
?>

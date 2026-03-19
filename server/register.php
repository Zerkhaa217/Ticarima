<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute([$data['username'], password_hash($data['password'], PASSWORD_DEFAULT)]);
echo json_encode(["status" => "success"]);
?>

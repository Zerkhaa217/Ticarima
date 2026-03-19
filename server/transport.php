<?php
require 'db.php';
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$userId = $_SESSION['user_id'];
$vehicleId = $data['vehicleId'];

$stmt = $conn->prepare("UPDATE vehicles SET is_rented = 1 WHERE id = ?");
$stmt->execute([$vehicleId]);
echo json_encode(["status" => "transporting"]);
?>

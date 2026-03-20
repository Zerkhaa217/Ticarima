<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$companyId = $data['companyId'];

$stmt = $conn->prepare("UPDATE companies SET owner_id = ?, merged = 1 WHERE id = ?");
$stmt->execute([$userId, $companyId]);
echo json_encode(["status" => "merged"]);
?>

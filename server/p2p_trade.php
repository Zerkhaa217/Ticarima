<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
// Logic: Transfer stock directly to a friendId
$stmt = $conn->prepare("UPDATE portfolio SET user_id = ? WHERE user_id = ? AND company_id = ?");
$stmt->execute([$data['friendId'], $userId, $data['companyId']]);
echo json_encode(["status" => "traded"]);
?>

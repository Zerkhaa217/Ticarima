<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if ($data['action'] === 'HIRE') {
    $conn->prepare("UPDATE users SET workers = workers + 1, cash = cash - 200 WHERE id = ?")->execute([$userId]);
    echo json_encode(["status" => "hired"]);
} elseif ($data['action'] === 'PAY') {
    $conn->prepare("UPDATE users SET cash = cash - (workers * 10) WHERE id = ?")->execute([$userId]);
    echo json_encode(["status" => "paid"]);
}
?>

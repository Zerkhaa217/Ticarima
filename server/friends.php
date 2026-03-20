<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if ($data['action'] === 'ADD') {
    $conn->prepare("INSERT INTO friends (user_id, friend_id) VALUES (?, ?)")->execute([$userId, $data['friendId']]);
    echo json_encode(["status" => "added"]);
} else {
    $stmt = $conn->prepare("SELECT u.username, u.level, u.xp FROM friends f JOIN users u ON f.friend_id = u.id WHERE f.user_id = ?");
    $stmt->execute([$userId]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
?>

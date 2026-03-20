<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);
$choice = $data['choice']; // 'risk' or 'safe'

if ($choice == 'risk') {
    $success = rand(0, 1);
    $amount = 5000;
    if ($success) {
        $conn->prepare("UPDATE users SET cash = cash + ? WHERE id = ?")->execute([$amount, $userId]);
        echo json_encode(["status" => "win", "msg" => "Risk tuttu! +5000 TL"]);
    } else {
        $conn->prepare("UPDATE users SET cash = cash - ? WHERE id = ?")->execute([$amount, $userId]);
        echo json_encode(["status" => "lose", "msg" => "Risk patladı! -5000 TL"]);
    }
} else {
    $conn->prepare("UPDATE users SET cash = cash + 100 WHERE id = ?")->execute([$userId]);
    echo json_encode(["status" => "safe", "msg" => "Garanti kazanç: +100 TL"]);
}
?>

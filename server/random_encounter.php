<?php
require 'db.php';
session_start();
$userId = $_SESSION['user_id'];

$encounters = [
    ["msg" => "Bir yatırımcı fabrikanı ziyaret etti! (+1000 TL)", "effect" => ["type" => "cash", "val" => 1000]],
    ["msg" => "İşçiler greve gitti! (Üretim durdu)", "effect" => ["type" => "production", "val" => 0]],
    ["msg" => "Hisse tavan yaptı! (+2000 TL)", "effect" => ["type" => "cash", "val" => 2000]]
];
$encounter = $encounters[array_rand($encounters)];

if ($encounter['effect']['type'] == 'cash') {
    $conn->prepare("UPDATE users SET cash = cash + ? WHERE id = ?")->execute([$encounter['effect']['val'], $userId]);
}

echo json_encode($encounter);
?>

<?php
require 'db.php';
// Rastgele bir "Black Swan" olayı oluştur
$events = ["Tech Krizi", "Kripto Boğa Koşusu", "Sağlık Sektörü İflas"];
$event = $events[array_rand($events)];
$impact = rand(-30, 30); // Fiyat etkisi

$stmt = $conn->prepare("UPDATE companies SET price = price + ? WHERE sector = ?");
$stmt->execute([$impact, $event]);
echo json_encode(["event" => $event, "impact" => $impact]);
?>

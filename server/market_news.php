<?php
require 'db.php';
$news_types = ["Enflasyon Artışı (Fiyatlar %5 arttı)", "Merkez Bankası Faiz Kararı (Likidite azaldı)", "Global Kriz (Borsa Çakıldı!)"];
$event = $news_types[array_rand($news_types)];

// Global etki: Fiyatları güncelle
if ($event == "Enflasyon Artışı (Fiyatlar %5 arttı)") {
    $conn->query("UPDATE companies SET price = price * 1.05");
} elseif ($event == "Global Kriz (Borsa Çakıldı!)") {
    $conn->query("UPDATE companies SET price = price * 0.7");
}

echo json_encode(["news" => $event]);
?>

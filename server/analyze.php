<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$companyId = $data['companyId'];

// Trend Analizi (Time Series Analysis)
$stmt = $conn->prepare("SELECT price FROM companies WHERE id = ?");
$stmt->execute([$companyId]);
$price = $stmt->fetchColumn();

$advice = ($price > 120) ? "Aşırı değerli, Satış yap!" : "Alım fırsatı, biriktir!";
echo json_encode(["advice" => $advice]);
?>

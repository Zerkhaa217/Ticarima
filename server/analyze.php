<?php
require 'config.php';
$apiKey = $groq_api_key;
$data = json_decode(file_get_contents("php://input"), true);
$companyId = $data['companyId'];
// ... (rest of logic) ...
?>

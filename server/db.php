<?php
require 'config.php';
try { $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass); } 
catch(PDOException $e) { die("DB Error"); }
?>

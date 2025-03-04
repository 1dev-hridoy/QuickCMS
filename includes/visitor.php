<?php
include_once './server/dbcon.php';

$currentDateTime = date('Y-m-d H:i:s');

$stmt = $pdo->prepare("INSERT INTO website_visitors (date) VALUES (?)");
$stmt->execute([$currentDateTime]);
?>
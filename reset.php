<?php
session_start();
date_default_timezone_set('Asia/Manila');
$db = new PDO('mysql:host=localhost;dbname=calorie_tracker;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("DELETE FROM intake_history");
header("Location: index.php#intake");
exit;
?>

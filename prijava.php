<?php
//Odprem sejo in dodam povezavo na bazo
session_start();
include ('x/dbconn.php');
//Dodam prijavo na hotel v podatkovno bazo
$sql = 'INSERT INTO hotel_logins(user_id, hotel_id) VALUES(?, ?)';
$stmt = $pdo->prepare ($sql)->execute ([$_SESSION['user_id'], $_GET['y']]);

$sql = 'UPDATE hotels SET filled_places = filled_places + 1 WHERE id = ?';
$stmt = $pdo->prepare ($sql)->execute ([$_GET['y']]);
header ('location:./');
?>
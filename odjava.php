<?php
//Odprem sejo in dodam povezavo na bazo
session_start();
include ('x/dbconn.php');
//Izbrišem prijavo na hotel iz podatkovno bazo
$sql = 'DELETE FROM hotel_logins WHERE user_id = ? AND hotel_id = ?';
$stmt = $pdo->prepare ($sql)->execute ([$_SESSION['user_id'], $_GET['y']]);

$sql = 'UPDATE hotels SET filled_places = filled_places - 1 WHERE id = ?';
$stmt = $pdo->prepare ($sql)->execute ([$_GET['y']]);

header ('location:./');
?>
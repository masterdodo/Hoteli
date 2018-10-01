<?php
include ('../x/dbconn.php');
$sql = 'DELETE FROM hotel_logins WHERE hotel_id = ?';
$stmt = $pdo->prepare ($sql)->execute ([$_GET['y']]);
$sql = 'DELETE FROM hotels WHERE id = ?';
$stmt = $pdo->prepare ($sql)->execute ([$_GET['y']]);
header ('location:../');
?>
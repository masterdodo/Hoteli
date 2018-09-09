<?php
require_once './povezavazbazo.php';
$id = $_GET['id'];
$imehotela = $_POST['ime_h'];
$ocenaa = $_POST['ocena'];
$opiss = $_POST['opis'];
$cenaa = $_POST['cena'];
$naslv = $_POST['naslov'];
$sljik=$_POST['sljika'];
$kraj=$_POST['kraj'];

$target = "images/".basename($sljik);

$sql = "UPDATE hoteli SET imeho = '$imehotela', ocena = '$ocenaa', opis = '$opiss', cena = '$cenaa', naslov = '$naslv', kraj_id='$kraj',slike='$target'
        WHERE id_h = '".$_GET['id']."';";

$res = mysqli_query($conn, $sql);
header('location:adminpage.php');
?>

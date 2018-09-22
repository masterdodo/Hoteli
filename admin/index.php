<?php
//Nastavim naslov, css pot in dodam header
$title = 'Glavna stran - Admin';
$css = '../css/main.css';
include '../x/header.php';
//Preverim če je admin prijavljen
require_once ('../x/checkadminlogin.php');
?>
        <a class="button-standard" href="iud/dodaj_ponudnika.php">Dodaj ponudnika</a><br /><br />
        <a class="button-standard" href="iud/odstrani_ponudnika.php">Odstrani ponudnika</a><br />
<?php
include '../x/footer.php';
?>
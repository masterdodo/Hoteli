<?php
//Preverim če je admin prijavljen
require_once ('../../x/checkadminlogin.php');

//Zahtevam povezavo na bazo
include ('../../x/dbconn.php');

//Preverim, če so poslani podatki
if (isset ($_GET['y']))
{
    //Izbrišem vse hotele v lasti tega ponudnika
    $sql = 'DELETE FROM hotels WHERE user_id = ?';
    $pdo->prepare ($sql)->execute ([$_GET['y']]);

    //Izbrišem ponudnika iz uporabnikov
    $sql = 'DELETE FROM users WHERE id = ?';
    $pdo->prepare ($sql)->execute ([$_GET['y']]);
}
//Na koncu v vsakem primeru preusmerim na prejšnjo stran
header ('location: odstrani_ponudnika.php');
?>
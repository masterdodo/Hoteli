<?php
//Preverim če je admin prijavljen
require_once ('../x/checkadminlogin.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Glavna stran - Admin</title>
    </head>
    <body>
        <a href="../logout.php">Odjava</a><br />
        <a href="iud/dodaj_ponudnika.php">Dodaj ponudnika</a><br />
        <a href="iud/odstrani_ponudnika.php">Odstrani ponudnika</a><br />

    </body>
</html>
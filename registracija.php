<?php include './registacijabaza.php'; ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="prvicss.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <title>Hoteli/registracija</title>
    </head>
    <body>
        <?php
        // put your code here
        include_once './header.php';
        ?>
        <div id="regist">
            <form method="POST" action="registacijabaza.php">
                Ime:
                <input type="text" placeholder="Vnesite ime" name="ime">
                Priimek:
                <input type="text" placeholder="Vnesite priimek" name="priimek">
                Geslo:
                <input type="text" placeholder="Geslo" name="geslo">
                Email:
                <input type="email" placeholder="Vnesite svojo e-pošto" name="email">
                Uporabniško ime:
                <input type="text" placeholder="Uporabniško ime" name="uime">
                <input type="submit" class="waves-effect waves-light btn gumbi" name="regis" value="Registracija">
                Že imaš račun<a href="prijava.php"> prijavi se tukaj</a>
            </form>
        </div>
        <?php
        // put your code here
        include_once './footer.php';
        ?>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>

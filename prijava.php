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
        <title>Hoteli/prijava</title>
    </head>
    <body>
        <?php
        
        include_once './header.php';
        ?>
        <div id="prjav">
            <form method="POST" action="prijavabaza.php">
                Uporabniško ime:
                <input type="text" name="uime" placeholder="Vnesite uporabniško ime"><br>
                Geslo:
                <input type="text" name="geslo" placeholder="Vnesite geslo"><br>
                <input type="submit" class="waves-effect waves-light btn gumbi" name="prjavse" value="Prijava">
                Registriraš se lahko <a href="registracija.php">tukaj</a>
            </form>  
        </div>
        <?php 
        include_once './footer.php';
        ?>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>

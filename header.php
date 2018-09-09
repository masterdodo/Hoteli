<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="prvicss.css" rel="stylesheet" >
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <title></title>
    </head>
    <body>
        <div id="header">
            <div id="hidden">tihasjh</div>
             <p id="naslov">HOTELI</p>
            <ul id="menu">
                <li class="menu1" id="prvi"> <a class="waves-effect waves-light btn gumbi" href="index.php">Domov</a></li>
                <?php
                session_start();
                if(isset($_SESSION['uporabnisko_ime']))
                {
                    if($_SESSION['uporabnisko_ime']==='admin')
                    {
                        echo '<li class="menu1" id="drugi"><a class="waves-effect waves-light btn gumbi" href="adminpage.php">Nad. plosca</a></li>';
                        echo '<li class="menu1" id="drugi"><a class="waves-effect waves-light btn gumbi" href="odjava.php">Odjava</a></li>';
                        echo "Pozdravljen ".$_SESSION['uporabnisko_ime']; 
                    }
                    else
                    {
                    echo '<li class="menu1" id="drugi"><a class="waves-effect waves-light btn gumbi" href="odjava.php">Odjava</a></li>';
                    echo "Pozdravljen ".$_SESSION['uporabnisko_ime'];   
                    }
                }
                else
                {
                    echo '<li class="menu1" id="drugi"><a class="waves-effect waves-light btn gumbi" href="prijava.php">Prijavi se</a></li>';
                    echo '<li class="menu1"><a class="waves-effect waves-light btn gumbi" href="registracija.php">Registriraj se</a></li>';
                }
                ?>
            </ul>
            
        </div>
        <?php
        ?>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>

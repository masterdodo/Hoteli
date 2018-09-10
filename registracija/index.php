<html>
    <head>
        <title>Registracija</title>
    </head>
    <body>
        <form action="signup.php" method="POST">
            <input type="text" name="email" placeholder="Epošta"><br />
            <input type="text" name="username" placeholder="Uporabniško ime"><br />
            <input type="password" name="password" placeholder="Geslo"><br />
            <input type="submit" name="submit" value="Registracija">
            <?php
            //Zaženem sejo in v primeru napak le te izpišem
            session_start();
            if ((isset ($_SESSION['err'])) && ($_SESSION['err'] != ""))
            {
                echo '<div id="err">' . $_SESSION['err'] . '</div>';
            }
            ?>
        </form>
    </body>
</html>
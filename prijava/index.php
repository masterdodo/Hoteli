<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prijava</title>
    </head>
    <body>
        <form action="checklogin.php" method="POST">
            <input type="text" name="email" placeholder="E-pošta"><br />
            <input type="password" name="password" placeholder="Geslo"><br />
            <input type="submit" name="submit" value="Prijava">
            <?php
            //Zaženem sejo in v primeru napak le te izpišem
            session_start();
            if ((isset ($_SESSION['err'])) && ($_SESSION['err'] != ""))
            {
                echo '<div id="err">' . $_SESSION['err'] . '</div>';
            }
            $_SESSION['err'] = "";
            ?>
        </form>
    </body>
</html>

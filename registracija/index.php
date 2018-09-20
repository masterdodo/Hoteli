<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registracija</title>
    </head>
    <body>
        <form action="signup.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="email" placeholder="Epošta"><br />
            <input type="text" name="username" placeholder="Uporabniško ime"><br />
            <input type="password" name="password" placeholder="Geslo"><br />
            <input type="file" name="avatar"><br />
            <input type="submit" name="submit" value="Registracija">
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
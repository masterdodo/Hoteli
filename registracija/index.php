<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registracija</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
    <div id="login-wrapper">
            <div id="login-subwrapper">
                <form action="signup.php" method="POST" enctype="multipart/form-data">
                    <input class="input-login-standard" type="text" name="email" placeholder="Epošta" required><br />
                    <input class="input-login-standard" type="text" name="username" placeholder="Uporabniško ime" required><br />
                    <input class="input-login-standard" type="password" name="password" placeholder="Geslo" required><br />
                    <input class="input-login-standard" type="password" name="passwordcheck" placeholder="Potrditev gesla" required><br />
                    <input class="input-login-standard" type="file" name="avatar"><br />
                    <input class="input-login-submit" type="submit" name="submit" value="Registracija">
                    <?php
                    //Zaženem sejo in v primeru napak le te izpišem
                    session_start();
                    if ((isset ($_SESSION['err'])) && ($_SESSION['err'] != ""))
                    {
                        echo '<div id="err">' . $_SESSION['err'] . '</div>';
                    }
                    $_SESSION['err'] = "";
                    ?>
                </form><br />
                <a href="../prijava/" class="button-standard">Prijavi se</a>
            </div>
        </div>
    </body>
</html>
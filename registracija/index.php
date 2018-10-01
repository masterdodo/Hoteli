<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
        <title>Registracija</title>
        <link rel="stylesheet" href="../css/main.css">
        <script src="../js/registracija.js"></script>
    </head>
    <body>
    <div id="register-wrapper">
            <div id="login-subwrapper">
                <form action="signup.php" method="POST" enctype="multipart/form-data">
                    <label for="email">E-pošta:</label><br /><input id="input-register-email" class="input-login-standard" type="text" name="email" placeholder="Epošta" onkeyup="checkInputOnKeyUpMail(this.value)" required><br />
                    <label for="username">Uporabniško ime:</label><br /><input id="input-register-user" class="input-login-standard" type="text" name="username" placeholder="Uporabniško ime" onkeyup="checkInputOnKeyUpUser(this.value)" required><br />
                    <label for="password">Geslo:</label><br /><input id="input-register-pass" class="input-login-standard" type="password" name="password" placeholder="Geslo" onkeyup="checkInputOnKeyUpPass(this.value)" required><br />
                    <label for="passwordcheck">Potrdite geslo:</label><br /><input id="input-register-passcheck" class="input-login-standard" type="password" name="passwordcheck" placeholder="Potrditev gesla" onkeyup="checkInputOnKeyUpPassCheck(this.value)" required><br />
                    <label for="avatar">Slika profila (ni obvezno):</label><br />
                    <input class="input-login-standard" type="file" name="avatar"><br />
                    <input id="input-register-submit" class="input-login-submit" type="submit" name="submit" value="Registracija">
                    <div class="errors" id="error-email"></div>
                    <div class="errors" id="error-user"></div>
                    <div class="errors" id="error-pass"></div>
                    <div class="errors" id="error-passcheck"></div>
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
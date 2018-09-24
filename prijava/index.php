<?php
session_start();
if (isset ($_SESSION['username']) && $_SESSION['username'] == "admin")
{
    header ('location:../admin/');
}
else if (isset ($_SESSION['username']))
{
    header ('location:../');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prijava</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <div id="login-wrapper">
            <div id="login-subwrapper">
            <form action="checklogin.php" method="POST">
                <input type="text" name="email" placeholder="E-pošta" class="input-login-standard" required><br />
                <input type="password" name="password" placeholder="Geslo" class="input-login-standard" required><br />
                <input type="submit" name="submit" value="Prijava" class="input-login-submit">
                <?php
                if ((isset ($_SESSION['err'])) && ($_SESSION['err'] != ""))
                {
                    echo '<div id="err">' . $_SESSION['err'] . '</div>';
                }
                $_SESSION['err'] = "";
                ?>
            </form>
            <br />

            <?php require ('../vendor/autoload.php');
            
            $g_client = new Google_Client();

            $g_client->setClientId("482990312667-lf56buca4n9gus09mj3scif7h0iqhk5i.apps.googleusercontent.com");
            $g_client->setClientSecret("-t3IisdFP5BlMs7KkIIcHLgI");
            $g_client->setRedirectUri("https://testing.aristovnik.com/hoteli/prijava/index.php");
            $g_client->setScopes("email");
            
            $auth_url = $g_client->createAuthUrl();
            echo "<a href='$auth_url'>Login Through Google </a>";

            ?>
            <a href="../registracija/" class="button-standard">Registriraj se</a>
            </div>
        </div>
    </body>
</html>

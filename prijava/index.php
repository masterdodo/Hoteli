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
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prijava</title>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="888956527514-q5opl62umv8bubmcsbaktbrhanm59p3f.apps.googleusercontent.com">
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <div id="login-wrapper">
            <form action="checklogin.php" method="POST">
                <input type="text" name="email" placeholder="E-pošta" class="input-login"><br />
                <input type="password" name="password" placeholder="Geslo" class="input-login"><br />
                <input type="submit" name="submit" value="Prijava" class="input-login-submit">
                <?php
                if ((isset ($_SESSION['err'])) && ($_SESSION['err'] != ""))
                {
                    echo '<div id="err">' . $_SESSION['err'] . '</div>';
                }
                $_SESSION['err'] = "";
                ?>
            </form>
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
    </body>
</html>

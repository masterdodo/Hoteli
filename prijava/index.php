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
        <script src="../js/main.js"></script>
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
            include ('../x/dbconn.php');
            
            $g_client = new Google_Client();

            $g_client->setClientId("482990312667-lf56buca4n9gus09mj3scif7h0iqhk5i.apps.googleusercontent.com");
            $g_client->setClientSecret("-t3IisdFP5BlMs7KkIIcHLgI");
            $g_client->setRedirectUri("https://testing.aristovnik.com/hoteli/prijava/index.php");
            $g_client->setScopes("email");
            
            $auth_url = $g_client->createAuthUrl();
            echo "<a href='$auth_url'><img src='../google-buttons/btn_google_signin_dark_normal_web.png'></a><br />";

            $code = isset($_GET['code']) ? $_GET['code'] : NULL;

            if(isset($code))
            {
                try
                {
                    $token = $g_client->fetchAccessTokenWithAuthCode($code);
                    $g_client->setAccessToken($token);
                }
                catch (Exception $e)
                {
                    echo $e->getMessage();
                }
                try
                {
                    $pay_load = $g_client->verifyIdToken();
                }
                catch (Exception $e)
                {
                    echo $e->getMessage();
                }
            }
            else
            {
                $pay_load = null;
            }
            if(isset($pay_load))
            {
                $sql = $pdo->prepare ('SELECT id, username, password, email, avatar FROM users WHERE email = ?');
                $sql->execute (array ($pay_load['email']));
                $result = $sql->fetch();
                if ($result)
                {
                    //Prijava
                    $hash = $result['password'];
                    $user_id = $result['id'];
                    $username = $result['username'];
                    $email = $result['email'];
                    $editor = 0;
                    $avatar = $result['avatar'];

                    if (password_verify ($pay_load['sub'], $hash))
                    {
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['editor'] = $editor;
                        $_SESSION['avatar'] = $avatar;
                        $_SESSION['google-user'] = 1;
                        header ('location:../');
                    }
                    else
                    {
                        echo 'Napačno geslo.';
                    }
                }
                else
                {
                    //Registracija
                    $token_hash = password_hash ($pay_load['sub'], PASSWORD_DEFAULT);
                    try
                    {
                        $sql = $pdo->prepare ('INSERT INTO users(username, email, password, edit_hotels, avatar) VALUES(?, ?, ?, ?, ?)');
                        $sql->execute (array ($pay_load['email'], $pay_load['email'], $token_hash, 0, 'https://testing.aristovnik.com/hoteli/assets/avatars/default/profile.png'));
                        
                        $sql1 = $pdo->prepare ('SELECT id, username, email, avatar FROM users WHERE email = ?');
                        $sql1->execute (array ($pay_load['email']));
                        $result1 = $sql1->fetch();
                        
                        $_SESSION['user_id'] = $result1['id'];
                        $_SESSION['username'] = $result1['username'];
                        $_SESSION['email'] = $result1['email'];
                        $_SESSION['editor'] = 0;
                        $_SESSION['avatar'] = $result1['avatar'];
                        $_SESSION['google-user'] = 1;

                        header ('location:../');
                    }
                    catch (PDOException $e)
                    {
                        echo 'Error: ' . $e->getMessage();
                    }
                }
            }
            ?>
            <br />
            <a href="../registracija/" class="button-standard">Registriraj se</a>
            </div>
        </div>
    </body>
</html>

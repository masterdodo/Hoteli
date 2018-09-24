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

            $code = isset($_GET['code']) ? $_GET['code'] : NULL;
            var_dump ($code);
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
            var_dump ($pay_load);
            if(isset($pay_load))
            {
                $sql = $pdo->prepare ('SELECT id, username, password, email, avatar FROM users WHERE email = ?');
                $sql->execute (array ($pay_load['email']));
                $result = $sql->fetch();
                echo '<br />';
                var_dump ($result);
                if ($result)
                {
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
                        header ('location:../');
                    }
                    else
                    {
                        echo 'Napačno geslo.';
                    }
                }
                else
                {
                    $token_hash = password_hash ($pay_load['sub'], PASSWORD_DEFAULT);
                    try
                    {
                        $sql = $pdo->prepare ('INSERT INTO users(username, email, password, editor, avatar) VALUES(?, ?, ?, ?, ?)');
                        $sql->execute (array ($pay_load['email'], $pay_load['email'], $token_hash, 0, '/data/testing.aristovnik.com/www/hoteli/assets/avatars/default/profile.png'));
                        
                        $sql = $pdo->prepare ('SELECT id, username, email, avatar FROM users WHERE email = ?');
                        $sql->execute (array ($pay_load['email']));
                        $result = $sql->fetch();
                        
                        $_SESSION['user_id'] = $result['id'];
                        $_SESSION['username'] = $result['username'];
                        $_SESSION['email'] = $result['email'];
                        $_SESSION['editor'] = 0;
                        $_SESSION['avatar'] = $result['avatar'];

                        header ('location:../');
                    }
                    catch (PDOException $e)
                    {
                        echo 'Error: ' . $e->getMessage();
                    }
                }
            }
            ?>
            <a href="../registracija/" class="button-standard">Registriraj se</a>
            </div>
        </div>
    </body>
</html>

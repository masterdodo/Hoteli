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
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="888956527514-q5opl62umv8bubmcsbaktbrhanm59p3f.apps.googleusercontent.com">
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

            <?php
            require ("../vendor/autoload.php");
            //Step 1: Enter you google account credentials
            $g_client = new Google_Client();

            $g_client->setClientId('482990312667-lf56buca4n9gus09mj3scif7h0iqhk5i.apps.googleusercontent.com');
            $g_client->setClientSecret('-t3IisdFP5BlMs7KkIIcHLgI');
            $g_client->setRedirectUri("https://testing.aristovnik.com/hoteli/prijava/index.php");
            $g_client->setScopes(array(
                "https://www.googleapis.com/auth/userinfo.email",
                "https://www.googleapis.com/auth/userinfo.profile",
                "https://www.googleapis.com/auth/plus.me"
                ));
            
            //Step 2 : Create the url
            $auth_url = $g_client->createAuthUrl();
            echo '<a href="' . $auth_url . '">Sign-in with Google</a>';
            
            //Step 3 : Get the authorization  code
            $code = isset($_GET['code']) ? $_GET['code'] : NULL;
            
            //Step 4: Get access token
            if(isset($code)) {
                try {
                    $token = $g_client->fetchAccessTokenWithAuthCode($code);
                    $g_client->setAccessToken($token);
                }catch (Exception $e){
                    echo $e->getMessage();
                }
                try {
                    $pay_load = $g_client->verifyIdToken();
                }catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else{
                $pay_load = null;
            }
            // if payload is set execute login or register
            if(isset($pay_load)){
            
                $sql_check = $conn->prepare("SELECT id FROM users WHERE email=?");
                $sql_check->execute(array($pay_load['email']));
                $result_check = $sql_check->fetch();
                echo $result_check['id'];
            
                if($result_check){
                    // login
                    $sql = $conn->prepare("SELECT password, id, username, email, avatar, edit_hotels FROM users WHERE email=?");
                    $sql->execute(array($pay_load['email'])); // insert email and execute
                    $result = $sql->fetch();
                
                    $hash = $result['password'];
                    $user_id = $result['id'];
                    $username = $result['email'];
                    $email = $result['email'];
                    $avatar = $result['avatar'];
                    $editor = $result['edit_hotels'];
                    if(password_verify($pay_load['sub'], $hash)){
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['editor'] = $editor;
                        $_SESSION['avatar'] = $avatar;
                        header("Location: ../");
                    }else{
                        echo "Geslo je napačno";
                    }
                }else{
                    //register
                    $token_hash = password_hash($pay_load['sub'], PASSWORD_DEFAULT);
                    try{
                        $sql_register = $conn->prepare("INSERT INTO users(username, email, password, edit_hotels, avatar) VALUES (?,?,?,?,?)");
                        $sql_register->execute(array($pay_load['name'], $pay_load['email'], $pay_load['email'], $token_hash,0,'/data/testing.aristovnik.com/www/hoteli/assets/avatars/default/profile.png'));
                        $_SESSION['user_id'] = $conn->lastInsertId();
                        header("Location: ./");
                    }catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
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

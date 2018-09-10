<?php
//Zahtevam povezavo na bazo
require_once ('../x/dbconn.php');

//Preverim če so bili podatki poslani
if ( isset ($_POST['submit']))
{
    //Trim-am vse vrednosti, ki jih dobim iz poslanih podatkov in jih shranim v nove spremenljivke
    $email = trim ($_POST['email']);
    $password = trim ($_POST['password']);

    //V spremenljivko result si zabeležim geslo, id in uporabniško ime
    $sql = $pdo->prepare("SELECT password, id, username FROM users WHERE email=?");
    $sql->execute(array($email));
    $result = $sql->fetch();

    //V spremenljivko result si zabeležim geslo, id in uporabniško ime
    $sql1 = $pdo->prepare("SELECT password, id, username FROM admin WHERE email=?");
    $sql1->execute(array($email));
    $result1 = $sql1->fetch();

    //Izpraznim session spremenljivko za errorje in nastavim err spremenljivko na 0
    session_start();
    $_SESSION['err'] = "";

    //Preverim če je epošta pravilna
    if (!$result && !$result1)
    {
        $_SESSION['err'] = "Epošta je napačna.";
        header ("Location: ./");
        exit;
    }

    //Shranim si vrednosti iz result v nove spremenljivke
    if ($result)
    {
        $hash = $result['password'];
        $user_id = $result['id'];
        $username = $result['username'];
    }
    else if ($result1)
    {
        $hash = $result1['password'];
        $user_id = $result1['id'];
        $username = $result1['username'];
    }

    //Preverim, če je geslo pravilno in si nato v sejo shranim id uporabnika, uporabniško ime in epošto
    if (password_verify ($password, $hash))
    {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        if ($username == "admin")
        {
            $_SESSION['admin'] = true;
            header("Location: ../admin/");
            exit;
        }
        else
        {
            header("Location: ../");
            exit;
        }
    }
    else
    {
        $_SESSION['err'] .= "Geslo je napačno.";
        header ('Location: ./');
        exit;
    }

}
//Če podatki niso bili poslani ga preusmerim na stran s formo
else
{
    header ("Location: ./");
    exit;
}
?>
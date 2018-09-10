<?php
//Zahtevam povezavo na bazo
require_once ('../x/dbconn.php');

//Preverim če so bili podatki poslani
if (isset ($_POST['submit']))
{
    //Trim-am vse vrednosti, ki jih dobim iz poslanih podatkov in jih shranim v nove spremenljivke
    $email = trim ($_POST['email']);
    $username = trim ($_POST['username']);
    $password = trim ($_POST['password']);

    //V spremenljivko result si zabeležim če uporabniško ime že obstaja
    $sql = $pdo->prepare ("SELECT * FROM users WHERE username = ?");
    $sql->execute (array ($username));
    $result = $sql->fetch();

    //V spremenljivko result1 si zabeležim če epošta že obstaja
    $sql1 = $pdo->prepare ("SELECT * FROM users WHERE email = ?");
    $sql1->execute (array ($email));
    $result1 = $sql1->fetch();

    //Izpraznim session spremenljivko za errorje in nastavim err spremenljivko na 0
    session_start();
    $_SESSION['err'] = "";
    $error = 0;

    //Preverim če uporabniško ime že obstaja
    if ($result)
    {
        $_SESSION['err'] = "Uporabniško ime že obstaja.\n";
        $error = 1;
    }
    //Preverim če epošta že obstaja
    if ($result1)
    {
        $_SESSION['err'] .= "Epošta že obstaja.\n";
        $error = 1;
    }
    //Preverim če je uporabniško ime admin
    if ($username == "admin")
    {
        $_SESSION['err'] .= "Napačna izbira uporabniškega imena.\n";
        $error = 1;
    }
    //Preverim če je geslo manjše od 8 znakov
    if (strlen ($password) < 8)
    {
        $_SESSION['err'] .= "Geslo mora biti večje od 8 znakov.";
        $error = 1;
    }

    //Preverim če ni bilo napak in ga vpišem v tabelo users
    if ($error == 0)
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql2 = $pdo->prepare ("INSERT INTO users(username, email, password) VALUES (?,?,?)");
        try
        {
            $sql2->execute (array ($username, $email, $pass_hash));
            header ("Location:../");
        }
        catch ( PDOException $err)
        {
            echo "Napaka!";
        }
    }
    //Preverim če je napaka in uporabnika pošljem nazaj na spletno stran s formo in mu izpišem napake
    else if ($error == 1)
    {
        header ("Location: ./");
    }
}
//Če podatki niso bili poslani ga preusmerim na stran s formo
else
{
    header ("Location: ./");
}

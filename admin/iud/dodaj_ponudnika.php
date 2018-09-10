<?php
//Zahtevam povezavo na bazo
require_once ('../../x/dbconn.php');

//Preverim če so bili podatki poslani
if (isset ($_POST['submit']))
{
    //Trim-am vse vrednosti, ki jih dobim iz poslanih podatkov in jih shranim v nove spremenljivke
    $email = trim ($_POST['email']);
    $username = trim ($_POST['email']);
    $password = trim ($_POST['password']);

    //V spremenljivko result si zabeležim če epošta že obstaja
    $sql = $pdo->prepare ("SELECT * FROM users WHERE email = ?");
    $sql->execute (array ($email));
    $result = $sql->fetch();

    //Nastavim spremenljivko error na 0
    $error = 0;

    //Preverim če epošta že obstaja
    if ($result)
    {
        echo "Epošta že obstaja.";
        $error = 1;
    }

    //Preverim če je geslo manjše od 8 znakov
    if (strlen ($password) < 8)
    {
        echo "Geslo mora biti večje od 8 znakov.";
        $error = 1;
    }

    //Preverim če ni bilo napak in ga vpišem v tabelo users
    if ($error == 0)
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = $pdo->prepare ("INSERT INTO users(username, email, password, edit_hotels) VALUES (?,?,?,1)");
        try
        {
            $sql->execute (array ($email, $email, $pass_hash));
            echo "Ponudnik uspešno dodan!";
        }
        catch ( PDOException $err)
        {
            echo "Napaka!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ponudnika</title>
</head>
<body>
    <form method="post">
        <input type="text" name="email" placeholder="Epošta"><br />
        <input type="password" name="password" placeholder="Geslo"><br />
        <input type="submit" name="submit" value="Dodaj">
    </form>
</body>
</html>
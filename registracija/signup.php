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
        if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0)
        {
            $avatar_path = "../assets/avatars/";
            $target_file = $avatar_path . basename($_FILES["avatar"]["name"]);
            $ext = '.' . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $profile_picture_db_path = "https://testing.aristovnik.com/hoteli/assets/avatars/" . $username . $ext;
            $uploadOk = 1;
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if($check !== false)
            {
                echo 'Datoteka je slika.';
                $uploadOk = 1;
            }
            else
            {
                echo 'Datoteka ni slika.';
                $uploadOk = 0;
            }
            if ($uploadOk == 1)
            {
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar_path . $username . $ext))
                {
                    echo 'Uspešno!';
                }
                else
                {
                    echo 'Neuspešno!';
                }
            }
            else
            {
                echo 'Napaka!';
            }
        }
        else
        {
            $profile_picture_db_path = 'https://testing.aristovnik.com/hoteli/assets/avatars/default/profile.png';
        }
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql2 = $pdo->prepare ("INSERT INTO users(username, email, password, avatar) VALUES (?,?,?,?)");
        try
        {
            $sql2->execute (array ($username, $email, $pass_hash, $profile_picture_db_path));
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

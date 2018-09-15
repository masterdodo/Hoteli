<?php
$title = "Uredi profil";
include ('../x/header.php');
require ('../x/dbconn.php');
?>
<?php
if (isset ($_POST['submit-username']))
{
    $sql = $pdo->prepare ("SELECT id FROM users WHERE username = ?");
    $sql->execute (array ($_POST['username']));
    $result = $sql->fetch();
    if ($result)
    {
        echo 'Uporabniško ime je zasedeno.';
    }
    else
    {
        $sql = 'UPDATE users SET username = ? WHERE id = ?';
        $stmt = $pdo->prepare ($sql)->execute ([$_POST['username'], $_SESSION['user_id']]);
        header ('location:./');
        echo 'Uporabniško ime spremenjeno';
    }
}
else if (isset ($_POST['submit-password']))
{
    $sql = 'UPDATE users SET password = ? WHERE id = ?';
    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare ($sql)->execute ([$pass_hash, $_SESSION['user_id']]);
    header ('location:./');
    echo 'Geslo spremenjeno';
}
?>
<form method="post">
    <input type="text" name="username" placeholder="Uporabniško ime"><br />
    <input type="submit" name="submit-username" value="Spremeni">
</form>
<br /><br />
<form method="post">
    <input type="password" name="password" placeholder="Geslo"><br />
    <input type="submit" name="submit-password" value="Spremeni">
</form>
<?php
include ('../x/footer.php');
?>
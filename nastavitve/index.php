<?php
$title = "Uredi profil";
$css = "../css/main.css";
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
        $_SESSION['username'] = $_POST['username'];
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
else if (isset ($_POST['submit-avatar']))
{
    $username = $_SESSION['username'];
    $avatar_path = "../assets/avatars/" . $username . "/";
    $target_file = $avatar_path . basename($_FILES["avatar"]["name"]);
    $ext = '.' . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $profile_picture_db_path = "/Hoteli/assets/avatars/" . $username . "/profile" . $ext;
    $uploadOk = 1;
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false)
    {
        //echo 'Datoteka je slika.';
        $uploadOk = 1;
    }
    else
    {
        //echo 'Datoteka ni slika.';
        $uploadOk = 0;
    }
    if (!file_exists($avatar_path))
    {
        if (!mkdir($avatar_path, 0755, true))
        {
            die ('Failed to create folder...');
        }
    }
    if ($uploadOk == 1)
    {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar_path . "profile" . $ext))
        {
            echo 'Uspešno!';
            $sql = $pdo->prepare ('UPDATE users SET avatar = ? WHERE id = ?');
            $sql->execute (array ($profile_picture_db_path, $_SESSION['user_id']));
            $_SESSION['avatar'] = $profile_picture_db_path;
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
?>
<form method="post">
    <input type="text" name="username" placeholder="Uporabniško ime" class="input-standard" required>
    <input type="submit" name="submit-username" value="Spremeni" class="input-submit">
</form>
<br />
<form method="post">
    <input type="password" name="password" placeholder="Geslo" class="input-standard" required>
    <input type="submit" name="submit-password" value="Spremeni" class="input-submit">
</form>
<br />
<form method="post" enctype="multipart/form-data">
    <label class="label-standard" for="avatar">Slika profila</label><br />
    <input type="file" name="avatar" class="input-standard" required>
    <input type="submit" name="submit-avatar" value="Spremeni" class="input-submit">
</form>
<?php
include ('../x/footer.php');
?>
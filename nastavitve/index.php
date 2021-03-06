<?php
$title = "Uredi profil";
$css = "../css/main.css";
$js = "../js/nastavitve.js";
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
    $avatar_path = "/data/testing.aristovnik.com/www/hoteli/assets/avatars/";
    $target_file = $avatar_path . basename($_FILES["avatar"]["name"]);
    $ext = '.' . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $profile_picture_db_path = "https://testing.aristovnik.com/hoteli/assets/avatars/" . $username . $ext;
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
    if ($uploadOk == 1)
    {
        error_reporting (E_ALL);
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar_path . $username . $ext))
        {
            echo 'Uspešno!';
            $sql = $pdo->prepare ('UPDATE users SET avatar = ? WHERE id = ?');
            $sql->execute (array ($profile_picture_db_path, $_SESSION['user_id']));
            $_SESSION['avatar'] = $profile_picture_db_path;
        }
        else
        {
            echo $avatar_path . $username . $ext;
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
    <input id="input-nastavitve-username" type="text" name="username" placeholder="Uporabniško ime" class="input-standard" onkeyup="checkInputOnKeUpUser(this.value)" required>
    <input id="input-nastavitve-username-submit" type="submit" name="submit-username" value="Spremeni" class="input-submit">
</form>
<br />
<form method="post">
    <input id="input-nastavitve-pass" type="password" name="password" placeholder="Geslo" class="input-standard" onkeyup="checkInputOnKeUpPass(this.value)" required <?php if (isset ($_SESSION['google-user'])){ echo 'disabled';} ?>>
    <input id="input-nastavitve-pass-submit" type="submit" name="submit-password" value="Spremeni" class="input-submit" <?php if (isset ($_SESSION['google-user'])){ echo 'disabled';} ?>>
</form>
<br />
<form method="post" enctype="multipart/form-data">
    <label class="label-standard" for="avatar">Slika profila</label><br />
    <input type="file" name="avatar" class="input-standard" required>
    <input type="submit" name="submit-avatar" value="Spremeni" class="input-submit">
</form>
<div class="errors" id="error-user"></div>
<div class="errors" id="error-pass"></div>
<?php
include ('../x/footer.php');
?>
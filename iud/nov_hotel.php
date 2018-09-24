<?php
if (isset ($_POST['submit']))
{
    session_start();
    //Zahtevam povezavo na bazo
    include ('../x/dbconn.php');
    //Urejanje slike
    $username = $_SESSION['username'];
    $hotel_name = $_POST['name'];
    $picture_path = "../assets/hotels/";
    $target_file = $picture_path . basename($_FILES["picture"]["name"]);
    $ext = '.' . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $newfile1 = $username . $hotel_name . $ext;
    $newfile1 = str_replace (' ', '', $newfile1);
    $picture_db_path = "https://testing.aristovnik.com/hoteli/assets/hotels/" . $newfile1;
    $uploadOk = 1;
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
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
        $newfile = $picture_path . $username . $hotel_name . $ext;
        $newfile = str_replace (' ', '', $newfile);
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $newfile))
        {
            //Napišem in izvedem INSERT stavek
            echo 'Uspešno!';
            $sql = 'INSERT INTO hotels(name, address, date_from, date_to, city_id, user_id, picture) VALUES(?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare ($sql)->execute ([$_POST['name'],$_POST['address'],$_POST['date_from'],$_POST['date_to'],$_POST['city'],$_SESSION['user_id'], $picture_db_path]);
            header ('location:../');
            exit;
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
<?php
$title = "Dodaj hotel";
$css = "../css/main.css";
include ('../x/header.php');
?>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Ime hotela" class="input-standard" required><br />
        <input type="text" name="address" placeholder="Naslov hotela" class="input-standard" required><br />
        <select name="city" class="input-standard">
        <?php
        include ('../x/dbconn.php');
        $stmt = $pdo->query ('SELECT * FROM cities');
        foreach ($stmt as $row)
        {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        ?>
        </select><br />
        <input type="date" name="date_from" class="input-standard" required><br />
        <input type="date" name="date_to" class="input-standard" required><br />
        <input type="file" name="picture" class="input-standard" required><br /><br />
        <input class="button-standard" type="submit" name="submit" value="Dodaj hotel">
    </form>
<?php
include ('../x/footer.php');
?>
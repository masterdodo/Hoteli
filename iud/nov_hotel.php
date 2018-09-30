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
            $sql = 'INSERT INTO hotels(name, address, date_from, date_to, filled_places, all_places, city_id, user_id, picture) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare ($sql)->execute ([$_POST['name'],$_POST['address'],$_POST['date_from'],$_POST['date_to'],0,$_POST['all_places'],$_POST['city'],$_SESSION['user_id'], $picture_db_path]);
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
    <table>
        <tr><td class="table-label-hotel"><label for="name">Ime hotela:</label></td><td><input type="text" name="name" placeholder="Ime hotela" class="input-standard" required></td></tr>
        <tr><td class="table-label-hotel"><label for="address">Naslov hotela:</label></td><td><input type="text" name="address" placeholder="Naslov hotela" class="input-standard" required></td></tr>
        <tr><td class="table-label-hotel"><label for="city">Kraj hotela:</label></td><td><select name="city" class="input-standard">
        <?php
        include ('../x/dbconn.php');
        $stmt = $pdo->query ('SELECT * FROM cities');
        foreach ($stmt as $row)
        {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        ?>
        </select></td></tr>
        <tr><td class="table-label-hotel"><label for="all_places">Število prostih mest:</label></td><td><input type="numbers" name="all_places" class="input-standard" placeholder="Število prostih mest" required></td></tr>
        <tr><td class="table-label-hotel"><label for="date_from">Datum prihoda:</label></td><td><input type="date" name="date_from" class="input-standard" required></td></tr>
        <tr><td class="table-label-hotel"><label for="date_to">Datum odhoda:</label></td><td><input type="date" name="date_to" class="input-standard" required></td></tr>
        <tr><td class="table-label-hotel"><label for="picture">Slika hotela:</label></td><td><input type="file" name="picture" class="input-standard" required></td></tr><br />
        <input class="button-standard" type="submit" name="submit" value="Dodaj hotel">
    </table>
    </form>
<?php
include ('../x/footer.php');
?>
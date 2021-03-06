<?php
if (isset ($_POST['submit']))
{
    //Zahtevam povezavo na bazo
    include ('../x/dbconn.php');
    //Napišem in izvedem UPDATE stavek
    $sql = 'UPDATE hotels SET name = ?, address = ?, date_from = ?, date_to = ?, all_places = ?, city_id = ? WHERE id = ?';
    $stmt = $pdo->prepare ($sql)->execute ([$_POST['name'],$_POST['address'],$_POST['date_from'],$_POST['date_to'],$_POST['all_places'],$_POST['city'],$_GET['y']]);
    header ('location:../');
}
else if (isset ($_POST['submit-picture']))
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
            //Napišem in izvedem UPDATE stavek
            echo 'Uspešno!';
            $sql = 'UPDATE hotels SET picture = ? WHERE id = ?';
            $stmt = $pdo->prepare ($sql)->execute ([$picture_db_path, $_GET['y']]);
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
$title = "Uredi hotel";
$css = "../css/main.css";
include ('../x/header.php');
?>
    <form method="post">
        <?php
        //Zahtevam povezavo na bazo
        include ('../x/dbconn.php');
        //Dobim podatke o hotelu, ki ga rabim
        $sql = $pdo->prepare ("SELECT * FROM hotels WHERE id = ?");
        $sql->execute (array ($_GET['y']));
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        //Izpišem obrazec z vpisanimi podatki
        echo '<table>
        <tr><td><label for="name">Ime hotela: </label></td><td><input type="text" name="name" placeholder="Ime hotela" value="' . $result['name'] . '" class="input-standard" required></td></tr>
        <tr><td><label for="address">Naslov hotela: </label></td><td><input type="text" name="address" placeholder="Naslov hotela" value="' . $result['address'] . '" class="input-standard" required></td></tr>
        <tr><td><label for="city">Kraj hotela: </label></td><td><select name="city" class="input-standard">';
        $stmt = $pdo->query ('SELECT * FROM cities');
        foreach ($stmt as $row1)
        {
            if ($row1['id'] == $result['city_id'])
            {
                $selected = 'selected';
            }
            else
            {
                $selected = '';
            }
            echo '<option ' . $selected . ' value="' . $row1['id'] . '">' . $row1['name'] . '</option>';
        }
        $date_from = $result['date_from'];
        $date_to = $result['date_to'];
        $date_from = new DateTime($date_from);
        $date_to = new DateTime($date_to);
        $dateresult_from = $date_from->format("Y-m-d");
        $dateresult_to = $date_to->format("Y-m-d");
        echo '</select></td></tr>
        <tr><td><label for="date_from">Datum prihoda: </label></td><td><input type="date" name="date_from" value="' . $dateresult_from . '" class="input-standard" required></td></tr>
        <tr><td><label for="date_to">Datum odhoda: </label></td><td><input type="date" name="date_to" value="' . $dateresult_to . '" class="input-standard" required></td></tr>
        <tr><td><label for="all_places">Prosta mesta: </label></td><td><input type="numbers" name="all_places" value="' . $result['all_places'] . '" class="input-standard" required></td></tr>';
        ?>
    </table>
        <input class="button-standard" type="submit" name="submit" value="Uredi hotel">
    </form><br />
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="name" value="<?php echo $result['name'] ?>">
        <label for="picture">Spremeni sliko hotela:</label><br />
        <input type="file" name="picture" class="input-standard" required><br />
        <input class="button-standard" type="submit" name="submit-picture" value="Uredi sliko hotela">
    </form>
</body>
</html>
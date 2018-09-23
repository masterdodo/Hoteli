<?php
if (isset ($_POST['submit']))
{
    //Zahtevam povezavo na bazo
    include ('../x/dbconn.php');
    //Napišem in izvedem UPDATE stavek
    $sql = 'UPDATE hotels SET name = ?, address = ?, date_from = ?, date_to = ?, city_id = ? WHERE id = ?';
    $stmt = $pdo->prepare ($sql)->execute ([$_POST['name'],$_POST['address'],$_POST['date_from'],$_POST['date_to'],$_POST['city'],$_GET['y']]);
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
    $picture_path = "../assets/hotels/" . $username . "/" . $hotel_name . "/";
    $target_file = $picture_path . basename($_FILES["picture"]["name"]);
    $ext = '.' . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $picture_db_path = "/Hoteli/assets/hotels/" . $username . "/" . $hotel_name . "/picture" . $ext;
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
    if (!file_exists($picture_path))
    {
        mkdir($picture_path, 0777, true);
    }
    if ($uploadOk == 1)
    {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $picture_path . "picture" . $ext))
        {
            //Napišem in izvedem INSERT stavek
            echo 'Uspešno!';
            $sql = 'UPDATE hotels SET picture = ?';
            $stmt = $pdo->prepare ($sql)->execute ([$picture_db_path]);
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
        echo '<input type="text" name="name" placeholder="Ime hotela" value="' . $result['name'] . '" class="input-standard" required><br />
              <input type="text" name="address" placeholder="Naslov hotela" value="' . $result['address'] . '" class="input-standard" required><br />
              <select name="city" class="input-standard">';
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
        echo '</select><br />
              <input type="date" name="date_from" value="' . $dateresult_from . '" class="input-standard" required><br />
              <input type="date" name="date_to" value="' . $dateresult_to . '" class="input-standard" required><br />';
        ?>
        <input class="button-standard" type="submit" name="submit" value="Uredi hotel">
    </form><br />
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="name" value="<?php echo $result['name'] ?>">
        <label for="picture">Spremeni sliko</label><br />
        <input type="file" name="picture" class="input-standard" required><br />
        <input class="button-standard" type="submit" name="submit-picture" value="Uredi sliko hotela">
    </form>
</body>
</html>
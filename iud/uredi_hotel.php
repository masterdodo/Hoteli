<?php
if (isset ($_POST['submit']))
{
    //Zahtevam povezavo na bazo
    include ('../x/dbconn.php');
    //Napišem in izvedem UPDATE stavek
    $sql = 'UPDATE hotels SET name = ?, address = ?, date_from = ?, date_to = ?, city_id = ? WHERE id = ?';
    $stmt = $pdo->prepare ($sql)->execute ([$_POST['name'],$_POST['address'],$_POST['date_from'],$_POST['date_to'],$_POST['city'],$_GET['y']]);
    var_dump ($stmt);
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
        echo '<input type="text" name="name" placeholder="Ime hotela" value="' . $result['name'] . '"><br />
              <input type="text" name="address" placeholder="Naslov hotela" value="' . $result['address'] . '"><br />
              <select name="city">';
        $stmt = $pdo->query ('SELECT * FROM cities');
        foreach ($stmt as $row1)
        {
            echo '<option value="' . $row1['id'] . '">' . $row1['name'] . '</option>';
        }
        $date_from = $result['date_from'];
        $date_to = $result['date_to'];
        $date_from = new DateTime($date_from);
        $date_to = new DateTime($date_to);
        $dateresult_from = $date_from->format("Y-m-d");
        $dateresult_to = $date_to->format("Y-m-d");
        echo '</select><br />
              <input type="date" name="date_from" value="' . $dateresult_from . '"><br />
              <input type="date" name="date_to" value="' . $dateresult_to . '"><br />';
        ?>
        <input class="button-submit" type="submit" name="submit" value="Uredi hotel">
    </form>
</body>
</html>
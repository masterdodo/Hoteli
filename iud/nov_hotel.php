<?php
if (isset ($_POST['submit']))
{
    session_start();
    //Zahtevam povezavo na bazo
    include ('../x/dbconn.php');
    //Napišem in izvedem UPDATE stavek
    $sql = 'INSERT INTO hotels(name, address, date_from, date_to, city_id, user_id) VALUES(?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare ($sql)->execute ([$_POST['name'],$_POST['address'],$_POST['date_from'],$_POST['date_to'],$_POST['city'],$_SESSION['user_id']]);
    header ('location:../');
    exit;
}
?>
<?php
$title = "Dodaj hotel";
$css = "../css/main.css";
include ('../x/header.php');
?>
    <form method="post">
        <input type="text" name="name" placeholder="Ime hotela"><br />
        <input type="text" name="address" placeholder="Naslov hotela"><br />
        <select name="city">
        <?php
        include ('../x/dbconn.php');
        $stmt = $pdo->query ('SELECT * FROM cities');
        foreach ($stmt as $row)
        {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        ?>
        </select><br />
        <input type="date" name="date_from"><br />
        <input type="date" name="date_to"><br />
        <input class="button-submit" type="submit" name="submit" value="Dodaj hotel">
    </form>
<?php
include ('../x/footer.php');
?>
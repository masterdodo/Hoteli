<?php
$title = "Hoteli";
include ('x/header.php');
require ('x/dbconn.php');
//Preverim, če je uporabnik ponudnik hotelov
if ($_SESSION['editor'] == 1)
{
    //Prikažem gumb za dodajanje hotelov
    echo '<a href="iud/nov_hotel.php" class="button-standard">Nov hotel</a>';
}
$stmt = $pdo->query ('SELECT id, name, address, date_from, date_to, user_id FROM hotels');
foreach ($stmt as $row)
{
    echo '<div id="hotel' . $row['id'] . '">
          <div class="ime-hotela">' . $row['name'] . '</div>
          <div class="naslov-hotela">' . $row['address'] . '</div>
          <div class="datum">Od: ' . $row['date_from'] . ' Do: ' . $row['date_to'] . '</div>';
if ($_SESSION['editor'] == 1 && $_SESSION['user_id'] == $row['user_id'])
{
    echo '<div class="gumbi">
          <a class="button-standard" href="iud/uredi_hotel.php?y=' . $row['id'] . '">Uredi hotel</a>
          <a class="button-standard" href="iud/izbrisi_hotel.php?y=' . $row['id'] . '">Izbriši hotel</a>
          </div>';
}
echo '</div><br />';
}

include ('x/footer.php');
?>

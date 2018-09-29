<?php
$title = "Hoteli";
$css = "css/main.css";
$js = "js/main.js";
include ('x/header.php');
require ('x/dbconn.php');
//Preverim, če je uporabnik ponudnik hotelov
if ($_SESSION['editor'] == 1)
{
    //Prikažem gumb za dodajanje hotelov
    echo '<a href="iud/nov_hotel.php" class="button-standard">Nov hotel</a><br /><br />';
}
$stmt = $pdo->query ('SELECT id, name, address, date_from, date_to, filled_places, all_places, user_id, picture, city_id FROM hotels ORDER BY id');
foreach ($stmt as $row)
{
    $date_from = $row['date_from'];
    $date_to = $row['date_to'];
    $date_from = new DateTime($date_from);
    $date_to = new DateTime($date_to);
    $dateresult_from = $date_from->format("d. m. Y");
    $dateresult_to = $date_to->format("d. m. Y");

    $sql = $pdo->prepare ("SELECT name FROM cities WHERE id = ?");
    $sql->execute (array ($row['city_id']));
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $city = $result['name'];
    echo '<div class="hotel-box" id="hotel' . $row['id'] . '">
          <img class="hotel-picture" src="' . $row['picture'] . '" alt="HOTEL" height="150">
          <div class="hotel-content">
          <div class="ime-hotela">' . $row['name'] . '</div>
          <div class="naslov-hotela">' . $row['address'] . ', ' . $city . '</div>
          <div>' . $row['filled_places'] . '/' . $row['all_places'] . '</div>
          <div class="datum"><b>Od:</b> ' . $dateresult_from . ' <b>Do:</b> ' . $dateresult_to . '</div>
          </div>';

    if ($_SESSION['editor'] == 1 && $_SESSION['user_id'] == $row['user_id'])
    {
        echo '<div class="gumbi">
              <a class="button-standard" href="iud/uredi_hotel.php?y=' . $row['id'] . '">Uredi hotel</a>
              <a class="button-standard" href="iud/izbrisi_hotel.php?y=' . $row['id'] . '">Izbriši hotel</a>
              </div>';
    }
    else if ($_SESSION['editor'] == 0)
    {
        $sql = $pdo->prepare("SELECT user_id, hotel_id FROM hotel_logins WHERE user_id = ? AND hotel_id = ?");
        $sql->execute([$_SESSION['user_id'], $row['id']]);
        $result = $sql->fetch();
        if (!$result)
        {
            echo '<div class="gumbi">';
            $sql_prijava = $pdo->prepare("SELECT filled_places, all_places FROM hotels WHERE id = ?");
            $sql_prijava->execute([$row['id']]);
            $result_prijava = $sql_prijava->fetch();
            if ($result_prijava['filled_places'] != $result_prijava['all_places'])
            {
            echo '<a id="button-prijava" class="button-standard" href="prijava.php?y=' . $row['id'] . '">Prijava na hotel</a>';
            }
            echo '</div>';
        }
        else
        {
            echo '<div id="login-done">Na ta hotel ste že prijavljeni!</div><a id="button-odjava" class="button-standard" href="odjava.php?y=' . $row['id'] . '">Odjava</a>';
        }
    }
    echo '</div><br />';
}

include ('x/footer.php');
?>

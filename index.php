<?php
require_once ('x/checkuserlogin.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Glavna stran</title>
    </head>
    <body>
        <?php
            include ('x/header.php');
        ?>
        <a href="logout.php">Odjava</a>
        <?php
            require_once ('x/dbconn.php');
            if ($_SESSION['editor'] == 1)
            {
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
        ?>
        <?php
            include ('x/footer.php');
        ?>
    </body>
</html>
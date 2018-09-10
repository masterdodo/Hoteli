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
                echo '<a href="iud/nov_hotel.php" id="nov-hotel-button">Nov hotel</a>';
            }
            $stmt = $pdo->query ('SELECT id, name, address, date_from, date_to, user_id FROM hotels');
            foreach ($stmt as $row)
            {
                echo '<div id="hotel' . $row['id'] . '">';
                echo '<div class="ime-hotela">' . $row['name'] . '</div>';
                echo '<div class="naslov-hotela">' . $row['address'] . '</div>';
                echo '<div class="datum">Od: ' . $row['date_from'] . ' Do: ' . $row['date_to'] . '</div>';
                if ($_SESSION['editor'] == 1)
                {
                    echo '<div class="gumbi">';
                    echo '<a href="iud/uredi_hotel.php?y=' . $row['id'] . '">Uredi hotel</a>';
                    echo '<a href="iud/izbrisi_hotel.php?y=' . $row['id'] . '">Izbriši hotel</a>';
                    echo '</div>';
                }
                echo '</div><br />';
            }
        ?>
        <?php
            include ('x/footer.php');
        ?>
    </body>
</html>
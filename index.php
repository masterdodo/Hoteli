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
        <?php
            if ($_SESSION['editor'] == 1)
            {
                echo '<a href="nov_hotel.php" id="nov-hotel-button">Nov hotel</a>';
            }
            $stmt = $pdo->prepare ('SELECT id, name, address, date_from, date_to FROM hotels');
            foreach ($stmt as $row)
            {
                echo '<div id="hotel' . $row['id'] . '">';
                echo '<div id="ime-hotela">' . $row['name'] . '</div>';
                echo '<div id="naslov-hotela">' . $row['address'] . '</div>';
                echo '<div id="datum">Od: ' . $row['date_from'] . ' ... Do: ' . $row['date_to'] . '</div>';
                echo '</div>';
            }
        ?>
        <?php
            include ('x/footer.php');
        ?>
    </body>
</html>
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi hotel</title>
</head>
<body>
    <form method="post">
        <?php
        //Zahtevam povezavo na bazo
        include ('../x/dbconn.php');
        $sql = 'SELECT * FROM hotels WHERE id = ?';
        $stmt = $pdo->prepare ($sql)->execute ([$_GET['y']]);
        $row = $stmt->fetch (PDO::FETCH_ASSOC);
        echo '<input type="text" name="name" placeholder="Ime hotela" value="' . $row['name'] . '"><br />
              <input type="text" name="address" placeholder="Naslov hotela" value="' . $row['address'] . '"><br />
              <select name="city">';
              $stmt = $pdo->query ('SELECT * FROM cities');
              foreach ($stmt as $row1)
              {
                  echo '<option value="' . $row1['id'] . '">' . $row1['name'] . '</option>';
              }
            $date_from = new DateTime($date_from);
            $date_to = new DateTime($date_to);
            $dateresult_from = $date_from->format("Y-m-d");
            $dateresult_to = $date_to->format("Y-m-d");
        echo '</select><br />
              <input type="date" name="date_from" value=""><br />
              <input type="date" name="date_to" value=""><br />';
        ?>
        <input class="button-submit" type="submit" name="submit" value="Dodaj hotel">
    </form>
</body>
</html>
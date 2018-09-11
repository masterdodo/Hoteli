<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj hotel</title>
</head>
<body>
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
</body>
</html>
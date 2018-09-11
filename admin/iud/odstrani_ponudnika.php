<?
//Preverim če je admin prijavljen
require_once ('../../x/checkadminlogin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odstrani ponudnika</title>
</head>
<body>
    <table>
        <thead>
            <td>Epošta</td>
            <td>Odstrani</td>
        </thead>
        <tbody>
            <?php
                //Zahtevam povezavo na bazo
                require_once ('../../x/dbconn.php');

                //Pripravim SELECT stavek
                $stmt = $pdo->query ('SELECT email, id FROM users WHERE edit_hotels = 1');

                //Zaženem foreach zanko v kateri izpišem vsakega ponudnika v svojo vrsto
                foreach ($stmt as $row)
                {
                    echo '<tr>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td><a href="izbrisi_ponudnika.php?y=' . $row['id'] . '">Odstrani</a></td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>
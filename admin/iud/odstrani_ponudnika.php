<?php
//Preverim če je admin prijavljen
require_once ('../../x/checkadminlogin.php');
//Dodam header
$title = 'Admin - Odstrani Ponudnika';
$css = '../../css/main.css';
include '../../x/header.php';
?>
    <table class="table-standard">
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
                    echo '<tr>
                          <td>' . $row['email'] . '</td>
                          <td><a class="table-button" href="izbrisi_ponudnika.php?y=' . $row['id'] . '">Odstrani</a></td>
                          </tr>';
                }
            ?>
        </tbody>
    </table>
<?php
include '../../x/footer.php';
?>
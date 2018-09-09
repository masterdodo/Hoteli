<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <meta charset="UTF-8">
        <title>Hoteli</title>
    </head>
    <body>
        <?php
        include_once './header.php';
        ?>
        <?php
        require_once './povezavazbazo.php';
        $sql="SELECT h.*, k.ime AS k_ime, d.ime AS d_ime FROM hoteli h INNER JOIN kraji k ON h.kraj_id = k.id INNER JOIN drzave d ON k.drzava_id = d.id";
        $res= mysqli_query($conn, $sql);
        echo '<table align="center">';
        echo '<tr>';
            echo '<th>Slika</th>';
            echo '<th>Ime</th>';
            echo '<th>Ocena</th>';
            echo '<th>Opis</th>';
            echo '<th>Cena</th>';
            echo '<th>Država</th>';
            echo '<th>Kraj</th>';
            echo '<th>Naslov</th>';
        echo '</tr>';
        
        while ($row = mysqli_fetch_array($res))
        {
            echo '<tr>';
            echo '<td><img width="300px" height="200px" src="'.$row['slike'].'"></td>';
                echo '<td>'.$row['imeho'].'</td>';
                echo '<td>'.$row['ocena'].'</td>';
                echo '<td>'.$row['opis'].'</td>';
                echo '<td>'.$row['cena'].'</td>';
                echo '<td>'.$row['d_ime'].'</td>';
                echo '<td>'.$row['k_ime'].'</td>';
                echo '<td>'.$row['naslov'].'</td>';
            echo'</tr>';
        }
        echo '</table>'
        
        ?>
        <?php
        include_once './footer.php';
        ?>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>

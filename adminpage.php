<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <meta charset="UTF-8">
        <title>Hoteli</title>
    </head>
    <body>
        <?php
        // put your code here
        include_once './header.php';
        ?>
        <?php
        require_once './povezavazbazo.php';
        $sql="SELECT h.id_h AS hid_h, h.*, k.ime AS k_ime, d.ime AS d_ime FROM hoteli h INNER JOIN kraji k ON h.kraj_id = k.id INNER JOIN drzave d ON k.drzava_id = d.id";
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
            echo '<th>'.'<a href="dodaj.php">Dodaj hotel</a></th>';
            //echo '<th>Odstrani</th>';
            //echo '<th>Uredi</th>';
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
                echo '<td>'.'<a href="delete.php?id='.$row['hid_h'].'">Odstrani</a></td>';
                echo '<td>'.'<a href="uredi.php?id='.$row['hid_h'].'">Uredi</a></td>';
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

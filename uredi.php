<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        require_once './povezavazbazo.php';
        
        $sql = "SELECT h.*,k.* FROM hoteli h INNER JOIN kraji k ON h.kraj_id=k.id WHERE h.id_h = '".$_GET['id']."';";
                
                $res = mysqli_query($conn, $sql);
                
                $row = mysqli_fetch_array($res);
                //{
                    $id = $row['id'];
                    echo '<form action="update.php?id=' . $_GET['id'] . '" method="post">';
                        
                        
                        echo '<p>Ime hotela:</p>';
                        echo '<input type="text" value="'.$row['imeho'].'" name="ime_h" >';
                        
                        echo '<p>Ocena:</p>';
                        echo '<input type="number" value="'.$row['ocena'].'" name="ocena" >';
                        
                        echo '<p>Opis:</p>';
                        echo '<textarea name="opis">'.$row['opis'].'</textarea>';
                        
                        echo '<p>Cena:</p>';
                        echo '<input type="text" value="'.$row['cena'].'" name="cena"  >';
                        
                        echo '<p>Naslov:</p>';
                        echo '<input type="text" value="'.$row['naslov'].'" name="naslov" >';
                        
                        echo '<p>Kraj:</p>';
                        echo '<select name="kraj">';
                        $sql = "SELECT * FROM kraji";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            echo "<option value=\"" . $row['id'] . "\">" . $row['ime'] . "</option>";
                        }
                        echo '</select>';
                        
                        echo '<p>Slika:</p>';
                        echo '<input type="file" value="'.$row['slike'].'" name="sljika" >';
                        
                        echo '<input type="submit" value="spremeni" name="spremeni" >';
                    echo '</form>';
                //}
                ?>
        
        
    </body>
</html>

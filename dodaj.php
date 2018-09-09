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
        require_once './povezavazbazo.php';
        // put your code here
        ?>
        <form method="POST" action="dodaj.php">
            Ime hotela:
            <input type="text" name="imeh" placeholder="Ime hotela">
            Ocena:
            <input type="number" name="ocena" min="1" max="5">
            Opis:
            <input type="text" name="opishotela" placeholder="Opis hotela">
            Cena:
            <input type="text" name="cenahotela" placeholder="Cena">
            Naslov:
            <input type="text" name="naslov" placeholder="Naslov">
            Kraj:
            <select name="kraj">
                <?php
                        require_once './povezavazbazo.php';
                        $sql = "SELECT * FROM kraji";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            echo "<option value=\"" . $row['id'] . "\">" . $row['ime'] . "</option>";
                        }
                ?>
            </select>
            Spletna stran:
            <input type="text" name="spletnastran" placeholder="URL spletne strani">
            Slike:
            <input type="file" name="slike" >
            <input type="submit" value="Dodaj" name="dodaj">
        </form>
        <?php     
        if (isset($_POST['dodaj'])) {
        $imeh = mysqli_real_escape_string($conn, $_POST['imeh']);
        $ocena= mysqli_real_escape_string($conn, $_POST['ocena']);
        $opishotela = mysqli_real_escape_string($conn, $_POST['opishotela']);
        $cena = mysqli_real_escape_string($conn, $_POST['cenahotela']);
        $naslov = mysqli_real_escape_string($conn, $_POST['naslov']);
        $spletnastran= mysqli_real_escape_string($conn, $_POST['spletnastran']);
        $image = mysqli_real_escape_string($conn, $_POST['slike']);
        $kraj= mysqli_real_escape_string($conn, $_POST['kraj']);
        
        $target = "images/".basename($image);
            
        $query = "INSERT INTO hoteli(imeho,ocena,opis, cena ,naslov, spletna_stran,slike,kraj_id) 
  			  VALUES('$imeh', $ocena, '$opishotela','$cena','$naslov','$spletnastran','$target',$kraj)";
  	mysqli_query($conn, $query);
        
  	header('location: adminpage.php');
        } 
        ?>
    </body>
</html>

<?php
    require_once './povezavazbazo.php';
    
    $sql = "DELETE FROM hoteli WHERE id_h = " . $_GET['id'];
    $result = mysqli_query($conn, $sql);
    
    header("location: adminpage.php");
?>
<?php
    session_start();
    include './povezavazbazo.php';
    $errors = array(); 
    
    if (isset($_POST['prjavse'])) {
    $upoimee = mysqli_real_escape_string($conn, $_POST['uime']);
  $gaslo = mysqli_real_escape_string($conn, $_POST['geslo']);

  
  	$gaslo = md5($gaslo);
  	$query = "SELECT uporabnisko_ime,geslo FROM uporabniki WHERE uporabnisko_ime='$upoimee' AND geslo='$gaslo'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
          
  	  $_SESSION['uporabnisko_ime'] = $upoimee;
          if($_SESSION['uporabnisko_ime']==='admin')
          {
              header('location: adminpage.php');
          }
          else
          {
              header('location: index.php');
          }
        }
        else {
  		
                header('location: prijava.php');
  	}
        
}
?>
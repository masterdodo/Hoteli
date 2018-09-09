<?php

include './povezavazbazo.php';
$errors = array(); 

if (isset($_POST['regis'])) {
  $ime = mysqli_real_escape_string($conn, $_POST['ime']);
  $priimek= mysqli_real_escape_string($conn, $_POST['priimek']);
  $geslo = mysqli_real_escape_string($conn, $_POST['geslo']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $upoime= mysqli_real_escape_string($conn, $_POST['uime']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($ime)) { array_push($errors, "Ime je potrebno"); }
  if (empty($priimek)) { array_push($errors, "Priimek je potreben"); }
  if (empty($email)) { array_push($errors, "Email je potreben"); }
  if (empty($geslo)) { array_push($errors, "Geslo je potrebno"); }
  if (empty($upoime)) { array_push($errors, "Uporabniško ime je potrebno"); }
  
  if (count($errors) == 0) {
  	$geslo = md5($geslo);

  	$query = "INSERT INTO uporabniki(ime,priimek,geslo, email, uporabnisko_ime) 
  			  VALUES('$ime', '$priimek', '$geslo','$email','$upoime')";
  	mysqli_query($conn, $query);
  	header('location: prijava.php');
  }
  }
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name="hoteli";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);
$conn->set_charset('utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
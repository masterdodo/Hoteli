<?php
session_start();
if (!isset ($_SESSION['username']) || $_SESSION['username'] != "admin")
{
    header("location:/hoteli/prijava/");
    exit;
}
else
{
    
}
?>
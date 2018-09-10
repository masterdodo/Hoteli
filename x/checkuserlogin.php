<?php
session_start();
if (!isset ($_SESSION['username']))
{
    header("location:/hoteli/prijava/");
    exit;
}
else
{
    
}
?>
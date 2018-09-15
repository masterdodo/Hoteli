<?php
session_start();
if (!isset ($_SESSION['username']))
{
    header("location:/hoteli/prijava/");
    exit;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo '<title>' . $title . '</title>'; ?>
    </head>
    <body>
    <div>
        <a href="/hoteli/nastavitve">Uredi profil</a>
        <a href="/hoteli/logout.php">Odjava</a>
    </div>

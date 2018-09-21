<?php
session_start();
if (!isset ($_SESSION['username']))
{
    header("location:/hoteli/prijava/");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
        <?php 
        echo '<link rel="stylesheet" href="' . $css . '">';
        echo '<title>' . $title . '</title>'; ?>
    </head>
    <body>
    <div id="header">
        <img src="<?php echo $_SESSION['avatar']; ?>" height="32" width="32" alt="PP" id="header-profile-picture"> <div id="header-username"><?php echo strtoupper($_SESSION['username']); ?></div>
        <a class="header-links" id="header-link-move-right" href="/hoteli/nastavitve">Uredi profil</a>
        <a class="header-links" href="/hoteli/logout.php">Odjava</a>
    </div>

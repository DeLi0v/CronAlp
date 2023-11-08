<?php
include_once("../../cookee.php");
startmysession(0, "/", "localhost", true, false);
?>

<!DOCTYPE html>
<html>

<head>
    <?php include("../../htmlHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php 
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>
    <?php include("head.php"); ?>
    <h2 style="text-align: center;">Добро пожаловать в административную панель!</h2>
    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>
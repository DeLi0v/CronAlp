<!DOCTYPE html>
<html>

<head>
    <?php include("../../htmlHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php 
    session_name("account");
    session_start();
    if($_SESSION["LogIn"] == 1) { ?>
    <?php include("head.php"); ?>
    <h2 style="text-align: center;">Добро пожаловать в административную панель!</h2>
    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>
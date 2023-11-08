<?php
include_once("../../cookee.php");
startmysession(0, "/", "localhost", true, false);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="equepmentCat-add">
    <?php 
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

    <?php include("../head.php"); ?>
    <h3 style="text-align:center;">Добавление категории оборудования</h3>
    <form class="add" action="/Pages/AdminPanel/Add/EquepmentCategoriesAdd.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="CategoryName">Наименование:</label>
                <input type="text" name="CategoryName" size="20px" required/>
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form>

    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>
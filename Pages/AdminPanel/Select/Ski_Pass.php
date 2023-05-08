<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="ski_pass">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Ski-pass</h3>
    <?php
        require("Select.php");
        SelectTable("Ski_pass");
    ?>
</body>

</html>
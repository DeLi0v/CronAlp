<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="operations">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Виды оказания услуг</h3>
    <?php
        require("Select.php");
        SelectTable("OperationTypes");
    ?>
</body>

</html>
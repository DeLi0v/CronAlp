<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="staff">
    <?php include("../../head.php"); ?>
    <?php
        require("Select.php");
        SelectTable("Staff");
    ?>
</body>

</html>
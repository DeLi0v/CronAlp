<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
</head>

<body class="staff">
    <?php include("../../head.php"); ?>
    <div>
    <?php
        require("Select.php");
        SelectTable("Staff")
    ?>
    </div>
</body>

</html>
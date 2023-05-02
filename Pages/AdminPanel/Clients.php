<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="Styles/MainStyles.css">
</head>

<body>
        <?php include "/head.php"; ?>
        <br>
        <?php
            require("Select.php");
            SelectTable("Clients")
        ?>
        </div>
    </body>
</html>
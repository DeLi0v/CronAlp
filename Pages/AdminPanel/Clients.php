<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
</head>
    <body>
        <div>
        <?php include "../../head.php"; ?>
        </div>
        <div>
        <?php
            require("Select.php");
            SelectTable("Clients")
        ?>
        </div>
    </div>
</body>

</html>
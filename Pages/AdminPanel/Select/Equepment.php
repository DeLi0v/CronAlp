<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="equepment">
    <?php include("../head.php"); ?>
    <h3 style="text-align:center;">Оборудование</h3>
    <?php
        require("Select.php");
        SelectTable("Equepments");
    ?>
</body>

</html>
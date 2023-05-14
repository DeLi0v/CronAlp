<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="services">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Услуги</h3>
    <?php
        require("Select.php");
        SelectTable("Services");
    ?>
</body>

</html>
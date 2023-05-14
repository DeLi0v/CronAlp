<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="clients">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Клиенты</h3>
    <?php
        require("Select.php");
        SelectTable("Clients");
    ?>
</body>

</html>
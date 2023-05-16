<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="bron-selected">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Список брони</h3>
    <?php
        require("Select.php");
        SelectTable("Bron");
    ?>
</body>

</html>
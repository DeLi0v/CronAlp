<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="equepmentCat">
    <?php include("../head.php"); ?>
    <h3 style="text-align:center;">Категории оборудования</h3>
    <?php
        require("Select.php");
        SelectTable("EquepmentCategories");
    ?>
</body>

</html>
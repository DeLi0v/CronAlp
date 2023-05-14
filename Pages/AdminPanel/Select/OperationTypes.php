<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="operations">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Виды оказания услуг</h3>
    <?php
        require("Select.php");
        SelectTable("OperationTypes");
    ?>
</body>

</html>
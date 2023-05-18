<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="staff">
    <?php include("../head.php"); ?>
    <h3 style="text-align:center;">Сотрудники</h3>
    <?php
        require("Select.php");
        SelectTable("Staff");
    ?>
</body>

</html>
<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="ski_pass">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Ski-pass</h3>
    <?php
        require("Select.php");
        SelectTable("Ski_pass");
    ?>
</body>

</html>
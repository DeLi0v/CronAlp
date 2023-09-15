<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="ski_pass">
    <?php 
    session_name("account");
    session_start();
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

        <?php include("../head.php"); ?>
        <h3 style="text-align:center;">Ski-pass</h3>
        <?php
            require("Select.php");
            SelectTable("Ski_pass");
        ?>
        
    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>
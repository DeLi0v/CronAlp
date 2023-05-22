<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="services">
    <?php 
    session_name("account");
    session_start();
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

        <?php include("../head.php"); ?>
        <h3 style="text-align:center;">Услуги</h3>
        <?php
            require("Select.php");
            SelectTable("Services");
        ?>
    
    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>
<?php
include_once("../../cookee.php");
startmysession(0, "/", "account", true, false);
?>

<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="services">
    <?php 
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
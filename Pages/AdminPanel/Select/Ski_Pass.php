<?php
include_once("../../../cookee.php");
startmysession(0, "/", "localhost", true, false);
?>

<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="ski_pass">
    <?php 
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

        <?php include("../head.php"); ?>
        <h3 style="text-align:center;">Ski-pass</h3>
        <?php
            require("Select.php");
            SelectTable("Ski_pass");
        ?>
        
        <?php } else { ?>
        <script>
            window.location.replace("/index.php")
        </script>
    <?php } ?>
</body>

</html>
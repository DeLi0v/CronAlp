<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="clients">
    <?php 
    session_name("account");
    session_start();
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

        <?php include("../head.php"); ?>

        <svg class="spinner" viewBox="0 0 50 50">
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>

        <h3 style="text-align:center;">Клиенты</h3>
        <?php
            require("Select.php");
            SelectTable("Clients");
        ?>

    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>
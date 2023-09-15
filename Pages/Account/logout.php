<?php 
session_name("account");
session_start();
session_unset();
header("Location: /index.php");
?>
<?php 
include_once("cookee.php"); 
startmysession(0,"/", "account",true,false); 
session_start();
session_unset();
header("Location: /index.php");
?>
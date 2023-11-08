<?php 
include_once("../../cookee.php"); 
startmysession(0,"/", "localhost",true,false); 
session_start();
session_unset();
header("Location: /index.php");
?>
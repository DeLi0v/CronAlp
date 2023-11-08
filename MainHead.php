<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<title>Альпийская крона</title>
<link rel="stylesheet" href="/Styles/MainStyles.css">
<?php
function startmysession($lifetime, $path, $domain, $secure, $httponly) {      
    if(!isset($_SESSION)){  
         session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
         @session_regenerate_id(true);    
             session_start();
         }    
    }
?>
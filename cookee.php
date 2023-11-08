<?php
function startmysession($lifetime, $path, $domain, $secure, $httponly) {      
    if(!isset($_SESSION)){  
         session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
         @session_regenerate_id(true);    
             session_start();
         }    
    }
?>
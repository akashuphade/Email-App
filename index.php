<?php 

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once(dirname(__FILE__) . "/public/ini/ini.php");

// Redirect browser 
header("Location: " . PathToUrl(BASE_PATH . '/emails.php')); 
  
exit; 
?> 
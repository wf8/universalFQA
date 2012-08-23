<?php
session_start(); 

require('fqa_config.php');

//destroy all of the session variables
$_SESSION = array(); 
session_destroy();
echo "success logout";
exit;
 
?>
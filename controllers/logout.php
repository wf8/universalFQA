<?php
// destroy all of the session variables
$_SESSION = array(); 
session_destroy();
require_once('views/logout.php');
?>
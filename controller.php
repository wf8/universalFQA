<?php
require_once('lib/fqa_config.php');
session_start(); 

// header
require_once('views/header.php');

// parse url
$url_parts = array_slice(explode('/',$_SERVER['REQUEST_URI']), 1);

switch($url_parts[0]){	
	case (''):
		require_once('views/landing.php');	
	break;
	case ('about'):
		require_once('views/about.php');
	break;
	case ('login'):
		require_once('views/login.php');
	break;
	case ('logout'):
		// destroy all of the session variables
		$_SESSION = array(); 
		session_destroy();
		require_once('views/logout.php');
	break;
	default:
		require_once('views/landing.php');
	break;
}

// footer
require_once('views/footer.php');
?>
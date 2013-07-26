<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav_disabled_links.php');
	require_once('../views/new_site.php');
}
?>
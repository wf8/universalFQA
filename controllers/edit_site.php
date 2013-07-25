<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav.php');

	$site = new Site( $url_parts[1] );
	
	if ($site->user_id !== $_SESSION['user_id'])
		require_once('../views/error.php');
	else
		require_once('../views/edit_site.php');
}
?>
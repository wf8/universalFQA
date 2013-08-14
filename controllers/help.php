<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav.php');
	
	if (isset($url_parts[1])) {
		if ($url_parts[1] == 'terminology') 
			require_once('../views/terminology.php');
		else if ($url_parts[1] == 'fqa') 
			require_once('../views/fqa.php');
		else
			require_once('../views/help.php');
	} else {
		require_once('../views/help.php');
	}
}
?>
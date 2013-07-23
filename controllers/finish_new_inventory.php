<?php
if( !$_SESSION['valid'] ) 
	require_once('views/login.php');
else {
	require_once('views/nav.php');


	// display view
	require_once('views/finish_new_inventory.php');
}
?>
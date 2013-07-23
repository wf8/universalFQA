<?php
if( !$_SESSION['valid'] ) 
	require_once('views/login.php');
else {
	require_once('views/nav.php');
	// get all the data for this inventory
	$assessment = new InventoryAssessment( $url_parts[1] );
	require_once('views/view_inventory.php');
}
?>
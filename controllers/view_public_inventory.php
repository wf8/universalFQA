<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav.php');

	// display view
	require_once('../views/view_public_inventory.php');
	/*
	// get all the data for this inventory
	$assessment = new InventoryAssessment( $url_parts[1] );
	// check that it is public
	if (is_null($assessment->id))
		require_once('../views/error.php');
	else {
		require_once('../views/nav.php');
		require_once('../views/view_public_inventory.php');
	} */
}
?>
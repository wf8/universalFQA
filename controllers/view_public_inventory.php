<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	// get all the data for this inventory
	$assessment = new InventoryAssessment( $url_parts[1] );
	if (is_null($assessment->id))
		require_once('../views/error.php');
	else {
		if ($assessment->private == 'public') {
			$_SESSION['assessment'] = serialize($assessment);
			require_once('../views/nav.php');
			require_once('../views/view_public_inventory.php');
		} else
			require_once('../views/error.php');
	}	
}
?>
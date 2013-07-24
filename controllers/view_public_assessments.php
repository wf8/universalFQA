<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav.php');
	// get this user's inventory assessments
	$inventory = new InventoryAssessment;
	$inventory_assessments = $inventory->get_all_public();
	// get this user's transect assessments
	$transect = new TransectAssessment;
	$transect_assessments = $transect->get_all_public();
	require_once('../views/view_public_assessments.php');
}
?>
<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav_disabled_links.php');
	
	// determine whether user has selected custom fqa db and get id
	if (strpos($url_parts[1], 'custom') !== false) {
		$fqa_id = substr($url_parts[1], 6); 
		$custom_fqa = true;
	} else {
		$fqa_id = $url_parts[1];
		$custom_fqa = false;
	}
	
	// check whether the user has an assessment already started in session
	if ($_SESSION['assessment'] == null) {
		$assessment = new InventoryAssessment();	
	} else {
		$assessment = unserialize($_SESSION['assessment']);
	}
	$assessment->fqa_id = $fqa_id;
	$assessment->custom_fqa = $custom_fqa;
	$_SESSION['assessment'] = serialize($assessment);
		
	if ($custom_fqa) {
		$fqa = new CustomFQADatabase();
		$scientific_names = $fqa->get_scientific_names($fqa_id);
		$acronyms = $fqa->get_acronyms($fqa_id);
		$common_names = $fqa->get_common_names($fqa_id);
	} else {
		$fqa = new FQADatabase();
		$scientific_names = $fqa->get_scientific_names($fqa_id);
		$acronyms = $fqa->get_acronyms($fqa_id);
		$common_names = $fqa->get_common_names($fqa_id);	
	}
	
	// display view
	require_once('../views/finish_new_inventory.php');
}
?>
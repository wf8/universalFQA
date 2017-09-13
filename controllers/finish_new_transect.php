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
	
	// get cover method selected
	$cover_method_id = $url_parts[2];

	// check whether the user has an assessment already started in session
	if ($_SESSION['assessment'] == null) {
		$assessment = new TransectAssessment();	
	} else {
		$assessment = unserialize($_SESSION['assessment']);
	}
	$assessment->fqa_id = $fqa_id;
	$assessment->custom_fqa = $custom_fqa;
	$assessment->cover_method_id = $cover_method_id;
	$_SESSION['assessment'] = serialize($assessment);
	
	// display view
	require_once('../views/finish_new_transect.php');
}
?>
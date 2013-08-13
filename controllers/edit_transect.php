<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {	
	if (!isset($url_parts[1]))
		require_once('../views/error.php');
	else {
		if (isset($_SESSION['assessment'])) {
			// already been editing the assessment, so get object out of session
			$assessment = unserialize($_SESSION['assessment']);
		} else {
			// just started editing, so get object out of db
			$assessment = new TransectAssessment( $url_parts[1] );
			// check if the inventory exists
			if (is_null($assessment->id)) {
				require_once('../views/error.php');
				exit;
			}
		}
		// get a list of all the fqa databases
		$fqa = new FQADatabase;
		$fqa_databases = $fqa->get_all();
		// get a list of this user's custom fqa databases
		$custom_fqa = new CustomFQADatabase;
		$custom_fqa_databases = $custom_fqa->get_all_for_user($_SESSION['user_id']);
		// keep assessment in session and display view
		$_SESSION['assessment'] = serialize($assessment);
		require_once('../views/nav_disabled_links.php');
		require_once('../views/edit_transect.php');	
	}
}
?>
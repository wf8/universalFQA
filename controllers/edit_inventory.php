<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {	
	if (!isset($url_parts[1]))
		require_once('../views/error.php');
	else {
		// get all the data for this inventory
		$assessment = new InventoryAssessment( $url_parts[1] );
		// check if the inventory exists
		if (is_null($assessment->id))
			require_once('../views/error.php');
		else {
			// get the fqa database's species data
			if ($assessment->custom_fqa) 
				$fqa = new CustomFQADatabase();
			else 
				$fqa = new FQADatabase();
			$scientific_names = $fqa->get_scientific_names($assessment->fqa_id);
			$acronyms = $fqa->get_acronyms($assessment->fqa_id);
			$common_names = $fqa->get_common_names($assessment->fqa_id);	
			// get a list of all the fqa databases
			$fqa = new FQADatabase;
			$fqa_databases = $fqa->get_all();
			// get a list of this user's custom fqa databases
			$custom_fqa = new CustomFQADatabase;
			$custom_fqa_databases = $custom_fqa->get_all_for_user($_SESSION['user_id']);
			// keep assessment in session and display view
			$_SESSION['assessment'] = serialize($assessment);
			require_once('../views/nav_disabled_links.php');
			require_once('../views/edit_inventory.php');
		}
	}
}
?>
<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else { 
	// get customized fqa details
	$states_provinces = StateProvince::get_states_provinces();
	$ecoregions = OmernikEcoregion::get_omernik_ecoregions();
	$custom_fqa_id = mysqli_real_escape_string($db_link, $url_parts[1]);
	$custom_fqas = new CustomFQADatabase;
	$custom_fqa_database = $custom_fqas->get_fqa($custom_fqa_id);
	// if fqa not found redirect user to view all databases
	if ($custom_fqa_database == NULL) {
		require_once('../views/nav.php');
		$fqa = new FQADatabase;
		$fqa_databases = $fqa->get_all();
		// get this user's custom fqa databases
		$custom_fqa_databases = $custom_fqas->get_all_for_user($_SESSION['user_id']);
		// display view
		require_once('../views/view_databases.php');
	} else {
		// get taxa for this db
		$taxa = $custom_fqa_database->get_taxa($custom_fqa_id);
		require_once('../views/nav_disabled_links.php');
		require_once('../views/edit_custom_database.php');
	}
}
?>
<?php
if( !$_SESSION['valid'] ) 
	require_once('views/login.php');
else { 
	// get customized fqa details
	$customized_fqa_id = mysql_real_escape_string($url_parts[1]);
	$custom_fqas = new CustomFQADatabase;
	$custom_fqa_databases = $custom_fqas->get_fqa($customized_fqa_id);
	// if fqa not found redirect user to view all databases
	if (mysql_num_rows($custom_fqa_databases) == 0) {
		require_once('views/nav.php');
		$fqa = new FQADatabase;
		$fqa_databases = $fqa->get_all();
		// get this user's custom fqa databases
		$custom_fqa_databases = $custom_fqas->get_all_for_user($_SESSION['user_id']);
		// display view
		require_once('views/view_databases.php');
	} else {
		$custom_fqa = mysql_fetch_assoc($custom_fqa_databases);
		$original_fqa_id = $custom_fqa['fqa_id'];
		$region = $custom_fqa['region_name'];
		$year = $custom_fqa['publication_year'];
		$description = $custom_fqa['description'];
		$customized_name = $custom_fqa['customized_name'];
		$customized_description = $custom_fqa['customized_description'];
		// get taxa for this db
		$taxa = $custom_fqas->get_taxa($customized_fqa_id);
		require_once('views/edit_custom_database.php');
	}
}
?>
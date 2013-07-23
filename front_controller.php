<?php
session_start();
require_once('models/user.php');
require_once('models/fqa_database.php');
require_once('models/custom_fqa_database.php');
require_once('models/custom_taxa.php');
require_once('models/inventory_assessment.php');
require_once('models/transect_assessment.php');

// parse url
$url_parts = array_slice(explode('/',$_SERVER['REQUEST_URI']), 1);

// route ajax requests
if ($url_parts[0] == 'ajax') {
	
	if (file_exists('controllers/ajax/' . $url_parts[1] . '.php')) {
		// load ajax controller
		require_once('controllers/ajax/' . $url_parts[1] . '.php');
	} else {
		// there is a problem, so load error page
		require_once('views/header.php');
		require_once('views/error.php');
		require_once('views/footer.php');
	}
	
// route view requests		
} else {	
	
	// insert header for all views
	require_once('views/header.php');
	if ($url_parts[0] == '') {
		// load landing page
		require_once('views/landing.php');
	} else if (file_exists('controllers/' . $url_parts[0] . '.php')) {
		// load correct controller
		require_once('controllers/' . $url_parts[0] . '.php');	
	} else {
		// default load error page
		require_once('views/error.php');
	}
	// insert footer for all views
	require_once('views/footer.php');
	
}
?>
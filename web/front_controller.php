<?php
session_start();
function __autoload($class_name) {
    require_once '../models/' . $class_name . '.php';
}

// hide unnecessary session side-effect warnings
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

// parse url
$url_parts = array_slice(explode('/',$_SERVER['REQUEST_URI']), 1);

// route ajax requests
if ($url_parts[0] == 'ajax') {
	
	if (file_exists('../controllers/ajax/' . $url_parts[1] . '.php')) {
		// load ajax controller
		require_once('../controllers/ajax/' . $url_parts[1] . '.php');
	} else {
		// there is a problem, so load error page
		require_once('../views/header.php');
		require_once('../views/error.php');
		require_once('../views/footer.php');
	}
	
// route view requests		
} else {	
	
	// insert header for all views
	require_once('../views/header.php');
	if ($url_parts[0] == '') {
		// load landing page
		require_once('../views/landing.php');
	} else if (file_exists('../controllers/' . $url_parts[0] . '.php')) {
		// load correct controller
		require_once('../controllers/' . $url_parts[0] . '.php');	
	} else {
		// default load error page
		require_once('../views/error.php');
	}
	// insert footer for all views
	require_once('../views/footer.php');
	
}
?>
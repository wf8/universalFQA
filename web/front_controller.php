<?php
session_start();
ini_set("include_path",$_SERVER["DOCUMENT_ROOT"]);
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}

function __autoload($class_name) {
    require_once '../models/' . $class_name . '.php';
}

// hide unnecessary session side-effect warnings
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

// parse url
$url_parts = array_slice(explode('/',$_SERVER['REQUEST_URI']), 1);

// route API requests
if ($url_parts[0] == 'get') {

    if ($url_parts[1] == 'database') {
        if (count($url_parts) < 4) {
            // get/database/ or get/database/id
            if ($url_parts[2] != '')
                $_SESSION['id'] = $url_parts[2];
            require_once('../controllers/api/download_database.php');
        } else {
            // get/database/id/inventory or get/database/id/transect
            $_SESSION['database_id'] = $url_parts[2];
            $_SESSION['assessment_type'] = $url_parts[3];
            require_once('../controllers/api/list_assessments.php');
        }
    } else if (count($url_parts) == 3 && ($url_parts[1] == 'inventory' || $url_parts[1] == 'transect')) {
        $_SESSION['assessment_type'] = $url_parts[1];
        $_SESSION['id'] = $url_parts[2];
        require_once('../controllers/api/download_assessment.php');
    } else {
        echo '{ "status" : "error", "message" : "Badly formed URL" }';
    }

// route ajax requests
} else if ($url_parts[0] == 'ajax') {
	
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
	//if ($url_parts[0] == 'test') {	
	//	require_once('test.php');
	//} else 
    if ($url_parts[0] == 'download_report') {	
		require_once('../views/download_report.php');
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
}
mysqli_close($db_link);
?>

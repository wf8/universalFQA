<?php
require('lib/fqa_config.php');
session_start(); 

// parse url
$url_parts = array_slice(explode('/',$_SERVER['REQUEST_URI']), 1);

// this is an ajax request
if ($url_parts[0] == 'ajax') {
	// perform ajax action
	switch($url_parts[1]) {	
	
		case ('login_user'):
			require_once('models/user.php');
			$user = new User;
			$user->login(mysql_real_escape_string($_POST['email']), $_POST['password']);
		break;
		
		case ('register_user'):
			// retrieve our data from POST
			$email = mysql_real_escape_string($_POST['email']);
			$first_name = mysql_real_escape_string($_POST['first_name']);
			$last_name = mysql_real_escape_string($_POST['last_name']);
			$pass1 = $_POST['password1'];
			$pass2 = $_POST['password2'];
			require_once('models/user.php');
			$user = new User;
			$user->register($email, $first_name, $last_name, $pass1, $pass2);
		break;
		
		case ('forgot_password'):
			require_once('models/user.php');
			$user = new User;
			$user->email_forgot_password(mysql_real_escape_string($_POST['email']));
		break;
		
		case ('change_user_info'):
			// retrieve our data from POST
			$email = mysql_real_escape_string($_POST['email']);
			$first_name = mysql_real_escape_string($_POST['first_name']);
			$last_name = mysql_real_escape_string($_POST['last_name']);
			$pass1 = $_POST['password1'];
			$pass2 = $_POST['password2'];
			require_once('models/user.php');
			$user = new User;
			$user->change_user_info($email, $first_name, $last_name, $pass1, $pass2);
		break;
		
	}
	
// this is a request to one of the views
} else {
	// insert header
	require_once('views/header.php');
	// determine which view
	switch($url_parts[0]) {	
	
		case (''):
			require_once('views/landing.php');	
		break;
		
		case ('about'):
			require_once('views/about.php');
		break;
		
		case ('login'):
			require_once('views/login.php');
		break;
		
		case ('logout'):
			// destroy all of the session variables
			$_SESSION = array(); 
			session_destroy();
			require_once('views/logout.php');
		break;
		
		case ('view_account'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else
				require_once('views/nav.php');
				require_once('views/view_account.php');
		break;
		
		case ('view_assessments'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else
				require_once('views/nav.php');
				require_once('views/view_assessments.php');
		break; 
		
		case ('view_databases'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else
				require_once('views/nav.php');
				// get all the fqa databases
				require('models/fqa_database.php');
				$fqa = new FQADatabase;
				$fqa_databases = $fqa->get_all();
				// get this user's custom fqa databases
				require('models/custom_fqa_database.php');
				$custom_fqa = new CustomFQADatabase;
				$custom_fqa_databases = $custom_fqa->get_all_for_user($_SESSION['user_id']);
				// display view
				require_once('views/view_databases.php');
		break; 
		
		default:
			require_once('views/landing.php');
		break;
	}
	// insert footer
	require_once('views/footer.php');
}
?>
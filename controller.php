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
		
		case ('database_import'):
			// get parameters
			$region = mysql_real_escape_string($_POST["region"]);
			$year = mysql_real_escape_string($_POST["year"]);
			$description = mysql_real_escape_string($_POST["description"]);
			$file = $_FILES["upload_file"];
			require_once('models/fqa_database.php');
			$fqa = new FQADatabase;
			$fqa->import_new($region, $year, $description, $file);
		break;
		
		case ('custom_fqa_update'):
			// get parameters
			$id = mysql_real_escape_string($_POST["id"]);
			$name = mysql_real_escape_string($_POST["name"]);
			$description = mysql_real_escape_string($_POST["description"]);
			require_once('models/custom_fqa_database.php');
			$fqa = new CustomFQADatabase;
			$fqa->update($id, $name, $description);
		break;
		
		case ('delete_custom_database'):
			$id = mysql_real_escape_string($_POST["id"]);
			require_once('models/custom_fqa_database.php');
			$fqa = new CustomFQADatabase;
			$fqa->delete($id);
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
			else {
				require_once('views/nav.php');
				require_once('views/view_account.php');
			}
		break;
		
		case ('view_assessments'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else {
				require_once('views/nav.php');
				require_once('views/view_assessments.php');
			}
		break; 
		
		case ('new_database'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else { 
				require_once('views/nav.php');
				require_once('views/new_database.php'); 
			}
		break;
		
		case ('view_databases'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else {
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
			}
		break; 
		
		case ('view_database'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else { 
				require_once('views/nav.php');
				// get the fqa database by id
				require('models/fqa_database.php');
				$id = mysql_real_escape_string($url_parts[1]);
				$fqa = new FQADatabase;
				$fqa_databases = $fqa->get_fqa($id); 
				// if database is not found show all databases
				if (mysql_num_rows($fqa_databases) == 0) {
					$fqa_databases = $fqa->get_all();
					// get this user's custom fqa databases
					require('models/custom_fqa_database.php');
					$custom_fqa = new CustomFQADatabase;
					$custom_fqa_databases = $custom_fqa->get_all_for_user($_SESSION['user_id']);
					// display view
					require_once('views/view_databases.php');
				} else { 
					$fqa_database = mysql_fetch_assoc($fqa_databases);
					$region = $fqa_database['region_name'];
					$year = $fqa_database['publication_year'];
					$description = $fqa_database['description'];
					// get fqa taxa
					$fqa_taxa = $fqa->get_taxa($id);
					$total_taxa = 0;
					$native_taxa = 0;
					$total_c = 0;
					$native_c = 0;
					$mean_total_c = 0;
					$mean_native_c = 0;
					while ($fqa_taxon = mysql_fetch_assoc($fqa_taxa)) {
						$total_taxa++;
						$total_c = $total_c + $fqa_taxon['c_o_c'];
						if ($fqa_taxon['native'] == true) {
							$native_taxa++;
							$native_c = $total_c + $fqa_taxon['c_o_c'];
						}
					}
					// reset pointer
					mysql_data_seek($fqa_taxa, 0);
					// calculate other fqa details
					if ($total_taxa !== 0)
						$mean_total_c = round(( $total_c / $total_taxa ), 1);
					if ($native_taxa !== 0)
						$mean_native_c = round(( $native_c / $native_taxa ), 1);
					$percent_native = round(( $native_taxa / $total_taxa ) * 100, 1);
					$percent_nonnative = 100 - $percent_native;
					// display view
					require_once('views/view_database.php');  
				}
			}
		break;
		
		case ('customize_database'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else { 
				require_once('views/nav.php');
				require('models/fqa_database.php');
				require('models/custom_fqa_database.php');
				// get original fqa details
				$original_fqa_id = mysql_real_escape_string($url_parts[1]);
				$fqa = new FQADatabase;
				$fqa_databases = $fqa->get_fqa($original_fqa_id); 
				// if database is not found show all databases
				if (mysql_num_rows($fqa_databases) == 0) {
					$fqa_databases = $fqa->get_all();
					// get this user's custom fqa databases
					$custom_fqa = new CustomFQADatabase;
					$custom_fqa_databases = $custom_fqa->get_all_for_user($_SESSION['user_id']);
					// display view
					require_once('views/view_databases.php');
				} else { 
					$fqa_database = mysql_fetch_assoc($fqa_databases);
					$region = $fqa_database['region_name'];
					$year = $fqa_database['publication_year'];
					$description = $fqa_database['description'];
					$custom_fqa = new CustomFQADatabase;
					$customized_fqa_id = $custom_fqa->insert_new($original_fqa_id, $region, $description, $year);
					// get original fqa taxa
					$fqa_taxa = $fqa->get_taxa($original_fqa_id);
					$custom_fqa->insert_taxa($customized_fqa_id, $original_fqa_id, $fqa_taxa);
					// get taxa for this db
					$taxa = $custom_fqa->get_taxa($customized_fqa_id);
					require_once('views/edit_custom_database.php');
				}
			}
		break;
		
		case ('edit_custom_database'):
			if( !$_SESSION['valid'] ) 
				require_once('views/login.php');
			else { 
				// get customized fqa details
				$customized_fqa_id = mysql_real_escape_string($url_parts[1]);
				require('models/custom_fqa_database.php');
				$custom_fqas = new CustomFQADatabase;
				$custom_fqa_databases = $custom_fqas->get_fqa($customized_fqa_id);
				// if fqa not found redirect user to view all databases
				if (mysql_num_rows($custom_fqa_databases) == 0) {
					require_once('views/nav.php');
					require('models/fqa_database.php');
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
		break;
					
		default:
			require_once('views/landing.php');
		break;
	}
	// insert footer
	require_once('views/footer.php');
}
?>
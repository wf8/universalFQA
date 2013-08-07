<?php
if( $_SESSION['valid'] ) {
	
	require('../config/db_config.php');
	$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno($db_link)) {
		error_log("Failed to connect to MySQL: " . mysqli_connect_error());
	}	
	
	$acronym = mysql_real_escape_string($db_link, $_POST['species']);
	$assessment = unserialize($_SESSION['assessment']);
	
	if ($assessment->add_taxa_by_column_value('acronym', $acronym)) {
		$_SESSION['assessment'] = serialize($assessment);
		echo 'success';
	}
}
?>
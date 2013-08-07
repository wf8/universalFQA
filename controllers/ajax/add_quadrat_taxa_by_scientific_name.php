<?php
if( $_SESSION['valid'] ) {
	
	require('../config/db_config.php');
	$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno($db_link)) {
		error_log("Failed to connect to MySQL: " . mysqli_connect_error());
	}	
	
	$scientific_name = mysqli_real_escape_string($db_link, $_POST['species']);
	$percent_cover = mysqli_real_escape_string($db_link, $_POST['percent_cover']);
	$quadrat = unserialize($_SESSION['quadrat']);
	
	if ($quadrat->add_taxa_by_column_value('scientific_name', $scientific_name, $percent_cover)) {
		$_SESSION['quadrat'] = serialize($quadrat);
		echo 'success';
	}
}
?>
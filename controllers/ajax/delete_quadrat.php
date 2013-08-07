<?php
if( $_SESSION['valid'] ) {
	require('../config/db_config.php');
	$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno($db_link)) {
		error_log("Failed to connect to MySQL: " . mysqli_connect_error());
	}

	$id = mysqli_real_escape_string($db_link, $_POST["id"]);
	$assessment = unserialize($_SESSION['assessment']);
	$i = 0;
	foreach ($assessment->quadrats as $quad) {
		if ($quad->name == $id) {
			unset($assessment->quadrats[$i]);
			$assessment->quadrats = array_values($assessment->quadrats);
			break;
		}
		$i++;
	}
	$_SESSION['assessment'] = serialize($assessment);
}
?>
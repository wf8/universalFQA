<?php
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}
$quadrat_name = mysqli_real_escape_string($db_link, $_POST["quadrat_name"]);
$assessment = unserialize($_SESSION['assessment']);
foreach ($assessment->quadrats as $quad) {
	if ($quad->name == $quadrat_name) {
		if ($quad->active)
			$quad->active = 0;
		else
			$quad->active = 1;
	}
}
$_SESSION['assessment'] = serialize($assessment);
?>
<?php
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}
$name = trim(mysql_real_escape_string($db_link, $_POST['name']));
$latitude = trim(mysql_real_escape_string($db_link, $_POST['latitude']));
$longitude = trim(mysql_real_escape_string($db_link, $_POST['longitude']));
$bare_ground = trim(mysql_real_escape_string($db_link, $_POST['bare_ground']));
$water = trim(mysql_real_escape_string($db_link, $_POST['water']));

if ($name == '') {
	echo 'Please enter a name or number for this quadrat.';
	exit;
}
if ($bare_ground !== '' && ( ($bare_ground < 0 || $bare_ground > 100) || !is_numeric($bare_ground) )) {
	echo 'Please enter a number between 0 and 100 for Percent Bare Ground.';
	exit;
}
if ($water !== '' && ( ($water < 0 || $water > 100) || !is_numeric($water) )) {
	echo 'Please enter a number between 0 and 100 for Percent Water.';
	exit;
}

// remove the old quadrat object we are replacing
$assessment = unserialize($_SESSION['assessment']);
$quadrat = unserialize($_SESSION['quadrat']);
$i = 0;
foreach ($assessment->quadrats as $quad) {
	if ($quad->name == $quadrat->name) {
		unset($assessment->quadrats[$i]);
		$assessment->quadrats = array_values($assessment->quadrats);
		break;
	}
	$i++;
}

// check that the quadrat name is unique for this transect
foreach ($assessment->quadrats as $quad) {
	if ($quad->name == $name) {
		echo 'There is already a quadrat with that name or number. Please enter a different name or number for this quadrat.';
		exit;
	}
}

// check that all the taxa have percent_cover
foreach ($quadrat->taxa as $taxon) {
	if ( (trim($taxon->percent_cover) == '') || ($taxon->percent_cover < 0 || $taxon->percent_cover > 100) || !is_numeric($taxon->percent_cover) ) {
		echo 'Please enter a number between 0 and 100 for Percent Cover.';
		exit;
	}
}

// update session quadrat object
$quadrat->name = $name;
$quadrat->latitude = $latitude;
$quadrat->longitude = $longitude;
$quadrat->percent_bare_ground = $bare_ground;
$quadrat->percent_water = $water;

// update session assessment object
$assessment->quadrats[] = $quadrat;
$_SESSION['assessment'] = serialize($assessment);
$_SESSION['quadrat'] = null;
echo 'success';
?>
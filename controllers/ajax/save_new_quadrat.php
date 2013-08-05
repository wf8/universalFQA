<?php
$name = trim(mysql_real_escape_string($_POST['name']));
$latitude = trim(mysql_real_escape_string($_POST['latitude']));
$longitude = trim(mysql_real_escape_string($_POST['longitude']));
$bare_ground = trim(mysql_real_escape_string($_POST['bare_ground']));
$water = trim(mysql_real_escape_string($_POST['water']));

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

// check that the quadrat name is unique for this transect
$assessment = unserialize($_SESSION['assessment']);
foreach ($assessment->quadrats as $quad) {
	if ($quad->name == $name) {
		echo 'There is already a quadrat with that name or number. Please enter a different name or number for this quadrat.';
		exit;
	}
}

// update session quadrat object
$quadrat = unserialize($_SESSION['quadrat']);
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
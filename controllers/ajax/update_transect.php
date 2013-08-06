<?php
$site_id = mysql_real_escape_string($_POST['site_id']);
$month = mysql_real_escape_string($_POST['month']);
$day = mysql_real_escape_string($_POST['day']);
$year = mysql_real_escape_string($_POST['year']);
$practitioner = mysql_real_escape_string($_POST['practitioner']);
$latitude = mysql_real_escape_string($_POST['latitude']);
$longitude = mysql_real_escape_string($_POST['longitude']);
$public_inventory = mysql_real_escape_string($_POST['public_inventory']);
$weather_notes = mysql_real_escape_string($_POST['weather_notes']);
$duration_notes = mysql_real_escape_string($_POST['duration_notes']);
$community_type_notes = mysql_real_escape_string($_POST['community_notes']);
$other_notes = mysql_real_escape_string($_POST['other_notes']);
 	
// update session assessment object
$assessment = unserialize($_SESSION['assessment']);
$assessment->site->id = $site_id;
if ($month < 10)
	$month = '0' . $month;
if ($day < 10)
	$day = '0' . $day;
$assessment->date = $year . '-' . $month . '-'. $day;
if ($public_inventory == 'public')
	$assessment->private = 0;
else
	$assessment->private = 1;
$assessment->practitioner = $practitioner;
$assessment->latitude = $latitude;
$assessment->longitude = $longitude;
$assessment->weather_notes = $weather_notes;
$assessment->duration_notes = $duration_notes;
$assessment->community_type_notes = $community_type_notes;
$assessment->other_notes = $other_notes;

$assessment->update();
$id = $assessment->id;
$_SESSION['assessment'] = null;
echo $id;
?>
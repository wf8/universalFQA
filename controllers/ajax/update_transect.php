<?php
$site_id = mysqli_real_escape_string($db_link, $_POST['site_id']);
$month = mysqli_real_escape_string($db_link, $_POST['month']);
$day = mysqli_real_escape_string($db_link, $_POST['day']);
$year = mysqli_real_escape_string($db_link, $_POST['year']);
$practitioner = mysqli_real_escape_string($db_link, $_POST['practitioner']);
$name = mysqli_real_escape_string($db_link, $_POST['name']);
$latitude = mysqli_real_escape_string($db_link, $_POST['latitude']);
$longitude = mysqli_real_escape_string($db_link, $_POST['longitude']);
$public_inventory = mysqli_real_escape_string($db_link, $_POST['public_inventory']);
$weather_notes = mysqli_real_escape_string($db_link, $_POST['weather_notes']);
$duration_notes = mysqli_real_escape_string($db_link, $_POST['duration_notes']);
$community_type_notes = mysqli_real_escape_string($db_link, $_POST['community_notes']);
$other_notes = mysqli_real_escape_string($db_link, $_POST['other_notes']);
 	
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
$assessment->name = $name;
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

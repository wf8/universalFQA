<?php
if (!isset($_POST['site_id'])) {
	// we need to insert a new site and get its id
	$site_name = mysqli_real_escape_string($db_link, $_POST['site_name']);
	$site_city = mysqli_real_escape_string($db_link, $_POST['site_city']);
	$site_county = mysqli_real_escape_string($db_link, $_POST['site_county']);
	$site_state = mysqli_real_escape_string($db_link, $_POST['site_state']);
	$site_country = mysqli_real_escape_string($db_link, $_POST['site_country']);
	$user_id = $_SESSION['user_id'];
	$site = new Site();
	$site_id = $site->save_first_site($user_id, $site_name, '', $site_city, $site_county, $site_state, $site_country);
} else {
	$site_id = mysqli_real_escape_string($db_link, $_POST['site_id']);
}
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
$transect_type = mysqli_real_escape_string($db_link, $_POST['transect_type']);
$plot_size = mysqli_real_escape_string($db_link, $_POST['plot_size']);
$subplot_size = mysqli_real_escape_string($db_link, $_POST['subplot_size']);
$transect_length = mysqli_real_escape_string($db_link, $_POST['transect_length']);
$transect_description = mysqli_real_escape_string($db_link, $_POST['transect_description']);
$cover_method_name = mysqli_real_escape_string($db_link, $_POST['cover_method_name']);
$community_type_id = mysqli_real_escape_string($db_link, $_POST['community_type_id']);
$environment_description = mysqli_real_escape_string($db_link, $_POST['environment_description']);

// update session assessment object
$assessment = unserialize($_SESSION['assessment']);
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
$assessment->transect_type = $transect_type;
$assessment->plot_size = $plot_size;
$assessment->subplot_size = $subplot_size;
$assessment->transect_length = $transect_length;
$assessment->transect_description = $transect_description;
$assessment->cover_method_name = $cover_method_name;
$assessment->community_type_id = $community_type_id;
$assessment->environment_description = $environment_description;

$new_id = $assessment->save($_SESSION['user_id'], $site_id);
$_SESSION['assessment'] = null;
echo $new_id;
?>

<?php
// retrieve our data from POST
$id = mysqli_real_escape_string($db_link, $_POST['id']);
$name = mysqli_real_escape_string($db_link, $_POST['name']);
$notes = mysqli_real_escape_string($db_link, $_POST['notes']);
$city = mysqli_real_escape_string($db_link, $_POST['city']);
$county = mysqli_real_escape_string($db_link, $_POST['county']);
$state = mysqli_real_escape_string($db_link, $_POST['state']);
$country = mysqli_real_escape_string($db_link, $_POST['country']);
$ecoregions = array();
if ($_POST["omernik_ecoregion"] != "null") {
	$posted_ecoregions = str_replace("selected", "", $_POST["omernik_ecoregion"]);
	$posted_ecoregions = json_decode($_POST["omernik_ecoregion"]);
	$ecoregions[] = mysqli_real_escape_string($db_link, $posted_ecoregions);
}
$site = new Site();
$site->save_site_changes($id, $name, $notes, $city, $county, $state, $country, $ecoregions);
?>
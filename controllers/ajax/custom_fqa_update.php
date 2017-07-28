<?php
// get parameters
$id = mysqli_real_escape_string($db_link, $_POST["id"]);
$name = mysqli_real_escape_string($db_link, $_POST["name"]);
$description = mysqli_real_escape_string($db_link, $_POST["description"]);
$states = array();
if ($_POST["state_prov"] != "null") {
	$posted_states = str_replace("selected", "", $_POST["state_prov"]);
	$posted_states = json_decode($posted_states);
	foreach ($posted_states as $state) {
		$states[] = mysqli_real_escape_string($db_link, $state);
	}
}
$ecoregions = array();
if ($_POST["omernik_ecoregion"] != "null") {
	$posted_ecoregions = str_replace("selected", "", $_POST["omernik_ecoregion"]);
	$posted_ecoregions = json_decode($_POST["omernik_ecoregion"]);
	foreach ($posted_ecoregions as $ecoregion) {
		$ecoregions[] = mysqli_real_escape_string($db_link, $ecoregion);
	}
}
$fqa = new CustomFQADatabase;
$fqa->update($id, $name, $description, $states, $ecoregions);
?>
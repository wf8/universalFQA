<?php
// get parameters
$region = mysqli_real_escape_string($db_link, $_POST["region"]);
$year = mysqli_real_escape_string($db_link, $_POST["year"]);
$description = mysqli_real_escape_string($db_link, $_POST["description"]);
$states = array();
foreach ($_POST["state_prov"] as $state) {
	$states[] = mysqli_real_escape_string($db_link, $state);
}
$ecoregions = array();
foreach ($_POST["omernik_ecoregion"] as $ecoregion) {
	$ecoregions[] = mysqli_real_escape_string($db_link, $ecoregion);
}
$file = $_FILES["upload_file"];
$fqa = new FQADatabase;
$fqa->import_new($region, $year, $description, $states, $ecoregions, $file);
?>
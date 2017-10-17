<?php
$name = trim(mysqli_real_escape_string($db_link, $_POST['name']));
$latitude = trim(mysqli_real_escape_string($db_link, $_POST['latitude']));
$longitude = trim(mysqli_real_escape_string($db_link, $_POST['longitude']));
$bare_ground = trim(mysqli_real_escape_string($db_link, $_POST['bare_ground']));
$water = trim(mysqli_real_escape_string($db_link, $_POST['water']));
$quadrat_type = trim(mysqli_real_escape_string($db_link, $_POST['quadrat_type']));

if ($name == '') {
	echo 'Please enter a name or number for this quadrat/subplot.';
	exit;
}

if (!ctype_alnum($name)) {
    echo 'The quadrat/subplot name can only contain alphanumeric characters.';
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
		echo 'There is already a quadrat/subplot with that name or number. Please enter a different name or number for this quadrat/subplot.';
		exit;
	}
}

// check that all the taxa have percent_cover
$quadrat = unserialize($_SESSION['quadrat']);
if ($assessment->cover_method_id == 0) {
    foreach ($quadrat->taxa as $taxon) {
        if ( (trim($taxon->percent_cover) == '') || ($taxon->percent_cover < 0 || $taxon->percent_cover > 100) || !is_numeric($taxon->percent_cover) ) {
            echo 'Please enter a number between 0 and 100 for Percent Cover.';
            exit;
        }
    }
}

// update session quadrat object
$quadrat->name = $name;
$quadrat->latitude = $latitude;
$quadrat->longitude = $longitude;
$quadrat->percent_bare_ground = $bare_ground;
$quadrat->percent_water = $water;
$quadrat->active = 1;
$quadrat->quadrat_type = $quadrat_type;
if ($quadrat_type == UFQA_FULL_PLOT OR $quadrat_type == UFQA_OUTSIDE_PLOT OR $quadrat_type == UFQA_REST_OF_PLOT) {
	$quadrat->active = 0;
} 

// update session assessment object
$assessment->quadrats[] = $quadrat;
$_SESSION['assessment'] = serialize($assessment);
$_SESSION['quadrat'] = null;
echo 'success';
?>

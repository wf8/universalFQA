<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	// Add in a none because the sol jquery plugin is not supporting none/optional correctly
	$omernik_ecoregions = OmernikEcoregion::get_omernik_ecoregions();
	$none_ecoregion = new OmernikEcoregion();
	$none_ecoregion->id = -1;
	$none_ecoregion->display_name = 'None Selected';
	array_unshift($omernik_ecoregions, $none_ecoregion);
	require_once('../views/nav_disabled_links.php');
	require_once('../views/new_site.php');
}
?>
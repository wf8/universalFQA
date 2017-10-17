<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav_disabled_links.php');

	$site = new Site( $url_parts[1] );
	// Add in a none because the sol jquery plugin is not supporting none/optional correctly
	$omernik_ecoregions = OmernikEcoregion::get_omernik_ecoregions();
	$none_ecoregion = new OmernikEcoregion();
	$none_ecoregion->id = -1;
	$none_ecoregion->display_name = 'None Selected';
	array_unshift($omernik_ecoregions, $none_ecoregion);
	
	if ($site->user_id !== $_SESSION['user_id'])
		require_once('../views/error.php');
	else
		require_once('../views/edit_site.php');
}
?>
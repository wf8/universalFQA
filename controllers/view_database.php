<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else { 
	require_once('../views/nav.php');
	// get the fqa database by id
	$id = mysqli_real_escape_string($db_link, $url_parts[1]);
	$fqa = new FQADatabase;
	$fqa_databases = $fqa->get_fqa($id); 
	// if database is not found show all databases
	if (mysqli_num_rows($fqa_databases) == 0) {
		$fqa_databases = $fqa->get_all();
		// get this user's custom fqa databases
		$custom_fqa = new CustomFQADatabase;
		$custom_fqa_databases = $custom_fqa->get_all_for_user($_SESSION['user_id']);
		// display view
		require_once('../views/view_databases.php');
	} else { 
		$fqa_database = mysqli_fetch_assoc($fqa_databases);
		$region = $fqa_database['region_name'];
		$year = $fqa_database['publication_year'];
		$description = $fqa_database['description'];
		// get states
		$states_provinces = StateProvince::get_states_provinces();
		$states = $fqa->get_states($id);
		// get ecoregions
		$omernik_ecoregions = OmernikEcoregion::get_omernik_ecoregions();
		$ecoregions = $fqa->get_ecoregions($id);
		// get fqa taxa
		$fqa_taxa = $fqa->get_taxa($id);
		$total_taxa = 0;
		$native_taxa = 0;
		$total_c = 0;
		$native_c = 0;
		$mean_total_c = 0;
		$mean_native_c = 0;
		while ($fqa_taxon = mysqli_fetch_assoc($fqa_taxa)) {
			$total_taxa++;
			$total_c = $total_c + $fqa_taxon['c_o_c'];
			if ($fqa_taxon['native'] == true) {
				$native_taxa++;
				$native_c = $total_c + $fqa_taxon['c_o_c'];
			}
		}
		// reset pointer
		mysqli_data_seek($fqa_taxa, 0);
		// calculate other fqa details
		if ($total_taxa !== 0)
			$mean_total_c = round(( $total_c / $total_taxa ), 1);
		if ($native_taxa !== 0)
			$mean_native_c = round(( $native_c / $native_taxa ), 1);
		$percent_native = round(( $native_taxa / $total_taxa ) * 100, 1);
		$percent_nonnative = 100 - $percent_native;
		// display view
		require_once('../views/view_database.php');  
	}
}
?>
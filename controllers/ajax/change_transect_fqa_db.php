<?php
if( $_SESSION['valid'] ) {
	
	require('../config/db_config.php');
	$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno($db_link)) {
		error_log("Failed to connect to MySQL: " . mysqli_connect_error());
	}	
	
	$new_fqa_id = mysqli_real_escape_string($db_link, $_POST['fqa_id']);
	$assessment = unserialize($_SESSION['assessment']);
	
	// determine whether user has selected custom fqa db and get id
	if (strpos($new_fqa_id, 'custom') !== false) {
		$new_fqa_id = substr($new_fqa_id, 6); 
		$custom_fqa = 1;
	} else {
		$custom_fqa = 0;
	}
	$assessment->fqa_id = $new_fqa_id;
	$assessment->custom_fqa = $custom_fqa;
	$error = '';
	// go through each quadrat
	foreach ($assessment->quadrats as $quadrat) {
		$quadrat->fqa_id = $new_fqa_id;
		$quadrat->custom_fqa = $custom_fqa;
		// get old taxa
		$old_taxa = $quadrat->taxa;
		$quadrat->taxa = array();
		// add old taxa
		foreach($old_taxa as $old_taxon) {
			// try to add by sci name, common name, and acronym
			if (!$quadrat->add_taxa_by_column_value('scientific_name', $old_taxon->scientific_name, $old_taxon->percent_cover)) 
				if (!$quadrat->add_taxa_by_column_value('common_name', $old_taxon->common_name, $old_taxon->percent_cover)) 
					if (!$quadrat->add_taxa_by_column_value('acronym', $old_taxon->acronym, $old_taxon->percent_cover)) 
						$error .= $old_taxon->scientific_name . ' in Quadrat ' . $quadrat->name . '<br>';
		}
	}
	$_SESSION['assessment'] = serialize($assessment);
	if ($error == '')
		echo '';
	else
		echo 'The following taxa were not found in the newly selected FQA database:<br>' . $error;
}
?>
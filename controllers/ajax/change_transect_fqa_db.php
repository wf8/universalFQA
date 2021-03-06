<?php
if( $_SESSION['valid'] ) {
	
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
	$cover_method = $assessment->get_cover_method();
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
			$cover_method_value = $cover_method->get_cover_method_value_for_percent_cover($old_taxon->percent_cover);
			if (!$quadrat->add_taxa_by_column_value('scientific_name', $old_taxon->scientific_name, $old_taxon->percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) 
				if (!$quadrat->add_taxa_by_column_value('common_name', $old_taxon->common_name, $old_taxon->percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) 
					if (!$quadrat->add_taxa_by_column_value('acronym', $old_taxon->acronym, $old_taxon->percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) 
						$error .= $old_taxon->scientific_name . ' in Quadrat/Subplot ' . $quadrat->name . '<br>';
		}
	}
	$_SESSION['assessment'] = serialize($assessment);
	if ($error == '')
		echo '';
	else
		echo 'The following taxa were not found in the newly selected FQA database:<br>' . $error;
}
?>
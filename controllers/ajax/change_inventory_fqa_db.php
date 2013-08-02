<?php
if( $_SESSION['valid'] ) {
	
	$new_fqa_id = mysql_real_escape_string($_POST['fqa_id']);
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
	
	// get old taxa
	$old_taxa = $assessment->taxa;
	$assessment->taxa = array();
	$error = '';
	// add old taxa
	foreach($old_taxa as $old_taxon) {
		// try to add by sci name, common name, and acronym
		if (!$assessment->add_taxa_by_column_value('scientific_name', $old_taxon->scientific_name)) 
			if (!$assessment->add_taxa_by_column_value('common_name', $old_taxon->common_name)) 
				if (!$assessment->add_taxa_by_column_value('acronym', $old_taxon->acronym)) 
					$error .= $old_taxon->scientific_name . '<br>';
	}
	$_SESSION['assessment'] = serialize($assessment);
	if ($error == '')
		echo '';
	else
		echo 'The following taxa were not found in the newly selected FQA database:<br>' . $error;
}
?>
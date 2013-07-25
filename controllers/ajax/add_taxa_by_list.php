<?php
if( $_SESSION['valid'] ) {
	
	$taxa_list = $_POST['taxa'];
	$assessment = unserialize($_SESSION['assessment']);
	
	$taxa_array = explode(',', $taxa_list);
	$html = 'The following taxa were not found in the FQA database:<br>';
	$taxa_not_found = false;
	foreach($taxa_array as $taxa) {
		$taxa = trim($taxa);
		// try to add taxa by all possible columns
		if (!$assessment->add_taxa_by_column_value('scientific_name', $taxa)) {
			if (!$assessment->add_taxa_by_column_value('common_name', $taxa)) {
				if (!$assessment->add_taxa_by_column_value('acronym', $taxa)) {
					$html = $html . $taxa . '<br>';
					$taxa_not_found = true;
				}
			}
		}
	}
	$_SESSION['assessment'] = serialize($assessment);
	if ($taxa_not_found)
		echo $html;
	else
		echo '';
}
?>
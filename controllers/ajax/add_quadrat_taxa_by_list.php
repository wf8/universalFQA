<?php
if( $_SESSION['valid'] ) {
	
	$taxa_list = $_POST['taxa'];
	$quadrat = unserialize($_SESSION['quadrat']);
	
	$taxa_array = explode(',', $taxa_list);
	$html = 'The following taxa were not found in the FQA database:<br>';
	$taxa_not_found = false;
	foreach($taxa_array as $taxa) {
		$taxa = trim($taxa);
		if ($taxa !== '') {
			// try to add taxa by all possible columns
			if (!$quadrat->add_taxa_by_column_value('scientific_name', $taxa)) {
				if (!$quadrat->add_taxa_by_column_value('common_name', $taxa)) {
					if (!$quadrat->add_taxa_by_column_value('acronym', $taxa)) {
						$html = $html . $taxa . '<br>';
						$taxa_not_found = true;
					}
				}
			}
		}
	}
	$_SESSION['quadrat'] = serialize($quadrat);
	if ($taxa_not_found)
		echo $html;
	else
		echo '';
}
?>
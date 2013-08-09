<?php
if( $_SESSION['valid'] ) {
	
	$taxa_list = $_POST['taxa'];
	$quadrat = unserialize($_SESSION['quadrat']);
	
	$taxa_array = explode(',', $taxa_list);
	$html = 'The following taxa were not found in the FQA database:<br>';
	$taxa_not_found = false;
	$i = 0;
	foreach($taxa_array as $list_item) {
		$list_item = trim($list_item);
		// when i is even we have the taxa name
		// when i is odd we have the percent cover
		if ($i % 2 == 0) {
			// $i is even
			$taxa = $list_item;
		} else {
			// $i is odd
			$percent_cover = $list_item;
			// now try to add the taxa
			if ($taxa !== '' && $percent_cover !== '') {
				// try to add taxa by all possible columns
				if (!$quadrat->add_taxa_by_column_value('scientific_name', $taxa, $percent_cover, $db_link)) {
					if (!$quadrat->add_taxa_by_column_value('common_name', $taxa, $percent_cover, $db_link)) {
						if (!$quadrat->add_taxa_by_column_value('acronym', $taxa, $percent_cover, $db_link)) {
							$html = $html . $taxa . '<br>';
							$taxa_not_found = true;
						}
					}
				}
			}
		}
		$i++;
	}
	$_SESSION['quadrat'] = serialize($quadrat);
	if ($taxa_not_found)
		echo $html;
	else
		echo '';
}
?>
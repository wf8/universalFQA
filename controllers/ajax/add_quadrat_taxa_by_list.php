<?php
if( $_SESSION['valid'] ) {
	
	$taxa_list = $_POST['taxa'];
	$list_type = $_POST['list_type'];
	$quadrat = unserialize($_SESSION['quadrat']);
	$assessment = unserialize($_SESSION['assessment']);
	
	$taxa_array = explode(',', $taxa_list);
	$taxa_html = 'The following taxa were not found in the FQA database:<br>';
	$taxa_not_found = false;
	$percent_cover_html = 'The following taxa had an invalid cover range midpoint value: <br>';
	$percent_cover_wrong = false;
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
			$cover_method = $assessment->get_cover_method();
			$cover_method_value = $cover_method->get_cover_method_value_for_percent_cover($percent_cover);
			if ($cover_method_value == NULL) {
				$percent_cover_html .= $taxa . ': '. $percent_cover . '<br>';
				$percent_cover_wrong = true;
			} else {
				// add taxa per cover method restrictions
				if ($taxa !== '' && $percent_cover !== '') {
					if ($list_type == 'scientific_name') {
						if (!$quadrat->add_taxa_by_column_value('scientific_name', $taxa, $percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) {
							$taxa_html = $taxa_html . $taxa . '<br>';
							$taxa_not_found = true;
						}
					}
					if ($list_type == 'common_name') {
						if (!$quadrat->add_taxa_by_column_value('common_name', $taxa, $percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) {
							$taxa_html = $taxa_html . $taxa . '<br>';
							$taxa_not_found = true;
						}
					}
					if ($list_type == 'acronym') {
						if (!$quadrat->add_taxa_by_column_value('acronym', $taxa, $percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) {
							$taxa_html = $taxa_html . $taxa . '<br>';
							$taxa_not_found = true;
						}
					}
				}
			}
		}
		$i++;
	}
	$_SESSION['quadrat'] = serialize($quadrat);
	$validation_errors_html = (!empty($taxa_html)) ? $taxa_html : '';
	$validation_errors_html .= (!empty($percent_cover_html)) ? $percent_cover_html : '';
	if ($taxa_not_found OR $percent_cover_wrong)
		echo $validation_errors_html;
	else
		echo '';
}
?>

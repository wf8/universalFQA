<?php
if( $_SESSION['valid'] ) {
	
	$taxa_list = $_POST['taxa'];
	$list_type = $_POST['list_type'];
	$quadrat = unserialize($_SESSION['quadrat']);
	$assessment = unserialize($_SESSION['assessment']);
	
	$taxa_array = explode(',', $taxa_list);
	$taxa_validation_msg = 'The following taxa were not found in the FQA database:<br>';
	$taxa_fails = '';
	$taxa_failed = false;
	$percent_cover_validation_msg = 'The following taxa had an invalid cover range midpoint value: <br>';
	$percent_cover_fails = '';
	$percent_cover_failed = false;
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
				$percent_cover_fails .= $taxa . ': '. $percent_cover . '<br>';
				$percent_cover_failed = true;
			} else {
				// add taxa per cover method restrictions
				if ($taxa !== '' && $percent_cover !== '') {
					if ($list_type == 'scientific_name') {
						if (!$quadrat->add_taxa_by_column_value('scientific_name', $taxa, $percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) {
							$taxa_fails .= $taxa . '<br>';
							$taxa_failed = true;
						}
					}
					if ($list_type == 'common_name') {
						if (!$quadrat->add_taxa_by_column_value('common_name', $taxa, $percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) {
							$taxa_fails .= $taxa . '<br>';
							$taxa_failed = true;
						}
					}
					if ($list_type == 'acronym') {
						if (!$quadrat->add_taxa_by_column_value('acronym', $taxa, $percent_cover, $cover_method_value->id, $cover_method->get_name(), $db_link)) {
							$taxa_fails .= $taxa . '<br>';
							$taxa_failed = true;
						}
					}
				}
			}
		}
		$i++;
	}
	$_SESSION['quadrat'] = serialize($quadrat);
	$validation_error_msg = (!empty($taxa_fails)) ? $taxa_validation_msg . $taxa_fails : '';
	$validation_error_msg .= (!empty($percent_cover_fails)) ? $percent_cover_validation_msg . $percent_cover_fails : '';
	if ($taxa_failed OR $percent_cover_failed)
		echo $validation_error_msg;
	else
		echo '';
}
?>

<?php
if( $_SESSION['valid'] ) {
	
	$taxa_list = $_POST['taxa'];
	$assessment = unserialize($_SESSION['assessment']);
	$list_type = $_POST['list_type'];

	$taxa_array = explode(',', $taxa_list);
	$html = 'The following taxa were not found in the FQA database:<br>';
	$taxa_not_found = false;
	foreach($taxa_array as $taxa) {
		$taxa = trim($taxa);
		if ($taxa !== '') {
			if ($list_type == 'scientific_name') {
                if (!$assessment->add_taxa_by_column_value('scientific_name', $taxa)) {
                    $html = $html . $taxa . '<br>';
                    $taxa_not_found = true;
                }
            }
			if ($list_type == 'common_name') {
                if (!$assessment->add_taxa_by_column_value('common_name', $taxa)) {
                    $html = $html . $taxa . '<br>';
                    $taxa_not_found = true;
                }
            }
			if ($list_type == 'acronym') {
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

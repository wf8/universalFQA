<?php
if( $_SESSION['valid'] ) {
	// get the fqa database by id
	$id = mysqli_real_escape_string($db_link, $_POST['id']);
	$fqa = new CustomFQADatabase($id);
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
	
	
	// start building csv
	$csv = array();
	$csv[] = array($fqa->region_name);
	$csv[] = array($fqa->publication_year);
	$csv[] = array($fqa->description);
	$csv[] = array($fqa->customized_name);
	$csv[] = array($fqa->customized_description);
	$csv[] = array($fqa->selection_display_name);
	
	$csv[] = array();
	$csv[] = array('Total Species:', $total_taxa);
	$csv[] = array('Native Species:', $native_taxa);
	$csv[] = array('Non-native Species:', $total_taxa - $native_taxa);
	$csv[] = array('Total Mean C:', $mean_total_c);
	$csv[] = array('Native Mean C:', $mean_native_c);
	
	$csv[] = array();
	$csv[] = array('Scientific Name', 'Family', 'Acronym', 'Native?', 'C', 'W', 'Physiognomy', 'Duration', 'Common Name');
	if ($total_taxa == 0) {
		$csv[] = array('There are no species in this inventory.');
	} else {
		while ($fqa_taxon = mysqli_fetch_assoc($fqa_taxa)) {
			if ($fqa_taxon['native'] == 1)
				$native = 'native';
			else
				$native = 'non-native';
			$csv[] = array(
							$fqa_taxon['scientific_name'],
							$fqa_taxon['family'],
							$fqa_taxon['acronym'],
							$native,
							$fqa_taxon['c_o_c'],
							$fqa_taxon['c_o_w'],
							$fqa_taxon['physiognomy'],
							$fqa_taxon['duration'],
							$fqa_taxon['common_name']
						);
		}
	}
	$csv_file = fopen('temp.csv', 'w');		
	foreach ($csv as $fields) {
		fputcsv($csv_file, $fields);
	}
	fclose($csv_file);	
	echo file_get_contents('temp.csv');		
}
?>
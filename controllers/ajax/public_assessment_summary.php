<?php
if( $_SESSION['valid'] ) {
	// get this user's inventory assessments
	$inventory = new InventoryAssessment;
	$inventory_assessments = $inventory->get_all_public();
	// get this user's transect assessments
	$transect = new TransectAssessment;
	$transect_assessments = $transect->get_all_public();

	// build csv array
	$csv = array();
	$csv[] = array('Public Inventory Assessments:');
	$csv[] = array('Site', 'Date', 'Native FQI', 'Total FQI', 'Adjusted FQI', 'Mean C', 'Native Mean C', 'Species Richness', 'Native Species Richness');
	foreach ($inventory_assessments as $assessment) {
		$csv[] = array(
						$assessment->site->name,
						$assessment->date,
						$assessment->metrics->native_fqi,
						$assessment->metrics->total_fqi,
						$assessment->metrics->adjusted_fqi,
						$assessment->metrics->total_mean_c,
						$assessment->metrics->native_mean_c,
						$assessment->metrics->total_species,
						$assessment->metrics->native_species,
					);
	}
	$csv[] = array();
	$csv[] = array('Public Transect Assessments:');
	$csv[] = array('Site', 'Date', 'Native FQI', 'Total FQI', 'Adjusted FQI', 'Mean C', 'Native Mean C', 'Species Richness', 'Native Species Richness');
	foreach ($transect_assessments as $assessment) {
		$csv[] = array(
						$assessment->site->name,
						$assessment->date,
						$assessment->metrics->native_fqi,
						$assessment->metrics->total_fqi,
						$assessment->metrics->adjusted_fqi,
						$assessment->metrics->total_mean_c,
						$assessment->metrics->native_mean_c,
						$assessment->metrics->total_species,
						$assessment->metrics->native_species,
					);
	}
	
	// get csv as string
	$csv_file = fopen('temp.csv', 'w');		
	foreach ($csv as $fields) {
		fputcsv($csv_file, $fields);
	}
	fclose($csv_file);		
	echo file_get_contents('temp.csv');
}
?>
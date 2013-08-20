<?php
if( $_SESSION['valid'] ) {
	// get this user's inventory assessments
	$inventory = new InventoryAssessment;
	$inventory_assessments = $inventory->get_all_for_user($_SESSION['user_id']);
	// get this user's transect assessments
	$transect = new TransectAssessment;
	$transect_assessments = $transect->get_all_for_user($_SESSION['user_id']);

	// build csv array
	$csv = array();
	$csv[] = array('Your Inventory Assessments:');
	$csv[] = array('Assessment Name', 'Date', 'Site', 'Practitioner', 'FQA Database', 'Public/Private', 'Native FQI', 'Total FQI', 'Adjusted FQI', 'Mean C', 'Native Mean C', 'Species Richness', 'Native Species Richness');
	foreach ($inventory_assessments as $assessment) {
		if ($assessment->custom_fqa)
			$fqa_db = $assessment->fqa->customized_name . ', ' . $assessment->fqa->publication_year; 
		else 
			$fqa_db = $assessment->fqa->region_name . ', ' . $assessment->fqa->publication_year;
		$csv[] = array(
						$assessment->name,
						$assessment->date,
						$assessment->site->name,
						$assessment->practitioner,
						$fqa_db,
						$assessment->private,
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
	$csv[] = array('Your Transect Assessments:');
	$csv[] = array('Assessment Name', 'Date', 'Site', 'Practitioner', 'FQA Database', 'Public/Private', 'Native FQI', 'Total FQI', 'Adjusted FQI', 'Mean C', 'Native Mean C', 'Species Richness', 'Native Species Richness');
	foreach ($transect_assessments as $assessment) {
		if ($assessment->custom_fqa)
			$fqa_db = $assessment->fqa->customized_name . ', ' . $assessment->fqa->publication_year; 
		else 
			$fqa_db = $assessment->fqa->region_name . ', ' . $assessment->fqa->publication_year;
		$csv[] = array(
						$assessment->name,
						$assessment->date,
						$assessment->site->name,
						$assessment->practitioner,
						$fqa_db,
						$assessment->private,
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

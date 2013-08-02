<?php
if( $_SESSION['valid'] ) {

	$fqa_id = mysql_real_escape_string($_POST['fqa_id']);
	
	// determine whether user has selected custom fqa db and get id
	if (strpos($fqa_id, 'custom') !== false) {
		$fqa_id = substr($fqa_id, 6); 
		$custom_fqa = 1;
	} else {
		$custom_fqa = 0;
	}
		
	// get data to populate typeaheads
	if ($custom_fqa) {
		$fqa = new CustomFQADatabase();
		$scientific_names = $fqa->get_scientific_names($fqa_id);
		$acronyms = $fqa->get_acronyms($fqa_id);
		$common_names = $fqa->get_common_names($fqa_id);
	} else {
		$fqa = new FQADatabase();
		$scientific_names = $fqa->get_scientific_names($fqa_id);
		$acronyms = $fqa->get_acronyms($fqa_id);
		$common_names = $fqa->get_common_names($fqa_id);	
	}
	$data = array();
	$data['scientific_name'] = $scientific_names;
	$data['acronym'] = $acronyms;
	$data['common_name'] = $common_names;
	echo json_encode($data);
}
?>
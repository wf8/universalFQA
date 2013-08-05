<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {	
	// get data to populate typeaheads
	$assessment = unserialize($_SESSION['assessment']);
	$fqa_id = $assessment->fqa_id;
	$custom_fqa = $assessment->custom_fqa;
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
	$quadrat_name = $url_parts[1];
	// get the quadrat object
	foreach ($assessment->quadrats as $quad) {
		if ($quad->name == $quadrat_name) {
			$quadrat = $quad;
			break;
		}
	}
	$_SESSION['quadrat'] = serialize($quadrat);
	// display view
	require_once('../views/nav_disabled_links.php');
	require_once('../views/edit_quadrat.php');
}
?>
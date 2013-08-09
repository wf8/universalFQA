<?php
ini_set('auto_detect_line_endings', true);
$file = $_FILES["upload_file"];
if ($file['error'] == 4)
	$result = 'Error: Please select a file.';
else if ($file['error'] > 0)
	$result = 'Error: ' . $file['error'];
else if	($file['size'] > 10490000) // 1.049e+7 bytes = 10 mb restriction
	$result = 'Error: File must be under 10 mb.';
else {
	$new_quadrats = false;
	$quadrats = array();
	$result = '';
	// parse file and save quadrats and quadrat taxa
	if (($handle = fopen($file['tmp_name'], "r")) !== FALSE) {
		$constructing_quadrat = false;
		$quadrat = null;
		$assessment = unserialize($_SESSION['assessment']);
		while (($data = fgetcsv($handle, ",")) !== FALSE) {
			if ( (trim(strtolower($data[0])) == 'quad') && !$constructing_quadrat) {
				// start a new quadrat
				$constructing_quadrat = true;
				$quadrat = new Quadrat(null, $db_link);
				$quadrat->fqa_id = $assessment->fqa_id;
				$quadrat->custom_fqa = $assessment->custom_fqa;
				$quadrat->name = trim($data[1]);
				$quadrat->active = 1;
				$quadrat->taxa = array();
				$new_quadrats = true;
			}
			if ( (trim(strtolower($data[0])) !== 'acronym') && (trim($data[0]) !== '>') && (trim(strtolower($data[0])) !== 'quad') && $constructing_quadrat) {
				// taxa to quadrat
				if (!$quadrat->add_taxa_by_column_value('acronym', $data[0], $data[1], $db_link))
					$result = $result . 'Acronym not found: ' . $data[0] . '<br>';
			}
			if ((trim($data[0]) == '>') && $constructing_quadrat) {
				// finish building quadrat and add it to array
				$quadrats[] = $quadrat;
				$constructing_quadrat = false;
			}
		}
		if ($constructing_quadrat) {
			// finish building the last quadrat and add it to array
			$quadrats[] = $quadrat;
			$constructing_quadrat = false;
		}
	}	
	if ($new_quadrats) {
		// add the new quadrats to the assessment in session
		$assessment->quadrats = $quadrats;
		$_SESSION['assessment'] = serialize($assessment);
		if ($result == '')
			$result = $result . 'Quadrat string successfully uploaded.';
		else
			$result = $result . 'Quadrat string uploaded.';
	} else
		$result = 'No quadrats found in quadrat string.';
}
echo '<html><head><script language="javascript" type="text/javascript">';
echo 'var result = ' . json_encode($result) . ';';
echo 'window.top.window.stop_upload_quadrat_string(result);';
echo '</script></head><body></body></html>';
?>
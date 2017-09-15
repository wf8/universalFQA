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
				// convert coverage vales 1=20, 2=40, 3=60, 4=80, 5=100
				/*
				if ($data[1] == '1')
					$cover = 20;
				else if ($data[1] == '2')
					$cover = 40;
				else if ($data[1] == '3')
					$cover = 60;
				else if ($data[1] == '4')
					$cover = 80;
				else if ($data[1] == '5')
					$cover = 100;
				else
					$cover = $data[1];
				*/
				// do not convert braun-blanquet cover values!
				$cover = $data[1];
				// add taxa to quadrat
				$cover_method = CoverMethod::get_cover_method($assessment->cover_method_id);
				$cover_method_value = $cover_method->get_cover_method_value_for_percent_cover($cover);
				if (!$quadrat->add_taxa_by_column_value('acronym', $data[0], $cover, $cover_method_value->id, $cover_method->get_name(), $db_link))
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
		$_SESSION['assessment'] = null;
		$_SESSION['assessment'] = serialize($assessment);
		if ($result == '')
			$result = $result . 'Quadrat/Subplot string successfully uploaded.';
		else
			$result = $result . 'Quadrat/Subplot string uploaded.';
	} else
		$result = 'No quadrats/subplots found in quadrat/subplot string.';
}
echo '<html><head><script language="javascript" type="text/javascript">';
echo 'var result = ' . json_encode($result) . ';';
echo 'window.top.window.stop_upload_quadrat_string(result);';
echo '</script></head><body></body></html>';
?>

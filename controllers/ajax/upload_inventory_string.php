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
	$result = '';
	// parse file and save taxa
	if (($handle = fopen($file['tmp_name'], "r")) !== FALSE) {
		$assessment = unserialize($_SESSION['assessment']);
		while (($data = fgetcsv($handle, ",")) !== FALSE) {
			if ( trim(strtolower($data[0])) !== 'acronym') {
				// add taxa to assessment 
				if (!$assessment->add_taxa_by_column_value('acronym', $data[0], $db_link))
					$result = $result . 'Acronym not found: ' . $data[0] . '<br>';
			}
		}
	}	
	$_SESSION['assessment'] = null;
	$_SESSION['assessment'] = serialize($assessment);
	if ($result == '')
		$result = $result . 'Inventory string successfully uploaded.';
	else
		$result = $result . 'Inventory string uploaded.';
}
echo '<html><head><script language="javascript" type="text/javascript">';
echo 'var result = ' . json_encode($result) . ';';
echo 'window.top.window.stop_upload_inventory_string(result);';
echo '</script></head><body></body></html>';
?>

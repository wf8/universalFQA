<?php
if( $_SESSION['valid'] ) {
	
	$scientific_name = mysqli_real_escape_string($db_link, $_POST['species']);

	$sql = "SELECT * FROM taxa WHERE scientific_name LIKE '%{$scientific_name}%'";
	$results = mysqli_query($db_link, $sql);
	if (mysqli_num_rows($results) == 0) {
		echo "<br><br><h4>Results:</h4>That name is not found in any FQA databases.";
	} else {
		$html = "<br><br><h4>Results:</h4>";
		$html = $html . '<table class="table table-hover"><tr>
				<td><strong>FQA DB</strong></td>
				<td><strong>Year</strong></td>
				<td><strong>Description</strong></td>
				<td><strong>Nativity</strong></td>
				<td><strong>Family</strong></td>
				<td><strong>Scientific Name</strong></td>
				<td><strong>Common Name</strong></td>
				<td><strong>Acronym</strong></td>
				<td><strong>C</strong></td>
				<td><strong>W</strong></td>
				<td><strong>Physiognomy</strong></td>
				<td><strong>Duration</strong></td></tr>';
		while ($result = mysqli_fetch_assoc($results)) {
			
			$fqa_id = $result['fqa_id'];
			$fqa = new FQADatabase($fqa_id);
			if ($fqa->region_name != null) {
				$html = $html . '<tr><td>'.$fqa->region_name.'</td><td>'.$fqa->publication_year.'</td><td>'.$fqa->description;
				if ($result['native'] == 1)
					$html = $html . '<td>native</td>';
				else
					$html = $html . '<td>non-native</td>';
				$html = $html . '<td>'.$result['family'].'</td><td>'.$result['scientific_name'].'</td><td>'.$result['common_name'].
						'</td><td>'.$result['acronym'].'</td><td>'.$result['c_o_c'].'</td><td>'.$result['c_o_w'].
						'</td><td>'.$result['physiognomy'].'</td><td>'.$result['duration'].'</td></tr>';
			}
		}
		echo $html . '</table>';
	}
}
?>

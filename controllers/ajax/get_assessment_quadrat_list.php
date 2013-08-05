<?php
if( $_SESSION['valid'] ) {
	
	$assessment = unserialize($_SESSION['assessment']);
	$html = '<table class="table table-hover"><tr>
			<td><strong>Active?</strong></td>
			<td><strong>Quadrat</strong></td>
			<td><strong>Species Richness</strong></td>
			<td><strong>Latitude</strong></td>
			<td><strong>Longitude</strong></td>
			<td></td>
			</tr>';	
error_log('count='.count($assessment->quadrats));
	if (count($assessment->quadrats) == 0) {
		$html = $html . '<tr><td colspan=6>You have not added any quadrats yet.</td></tr>';
	} else {
		$sorted_quadrats = sort_array_of_objects($assessment->quadrats, 'name');
		foreach ($sorted_quadrats as $quadrat) {
			$html = $html . '<tr><td><input type="checkbox" name="quadrat" value="' . $quadrat->name . '"></td>';
			$html = $html . '<td>' . $quadrat->name . '</td>';
			$html = $html . '<td>' . $quadrat->get_species_richness() . '</td>';
			$html = $html . '<td>' . prettify_value($quadrat->latitude) . '</td>';
			$html = $html . '<td>' . prettify_value($quadrat->longitude) . '</td>';
			$html = $html . '<td><a href="/edit_quadrat/'.$quadrat->name.'">Edit</a> | <a href="/delete_quadrat/'.$quadrat->name.'">Delete</a></td></tr>';
		}
	}
	echo $html . '</table>';
}

function prettify_value( $value ) {
	if (trim($value) == '') 
		return 'n/a';
	else
		return $value;
}

function sort_array_of_objects($arr, $var) { 
	$tarr = array(); 
	$rarr = array(); 
	for($i = 0; $i < count($arr); $i++) { 
	  $element = $arr[$i]; 
	  $tarr[] = strtolower($element->{$var}); 
	} 
	reset($tarr); 
	asort($tarr); 
	$karr = array_keys($tarr); 
	for($i = 0; $i < count($tarr); $i++) { 
	  $rarr[] = $arr[intval($karr[$i])]; 
	} 
	return $rarr; 
} 
?>
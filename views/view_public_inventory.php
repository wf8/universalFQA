    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Public Inventory Assessment</h1>
					<button class="btn btn-info" onClick="download_inventory(<?php echo $assessment->id; ?>);">Download Report</button> 
					<button class="btn btn-info" onclick="javascript:window.location = '/view_public_assessments';return false;">Done</button>
					<br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Date & Location:</h4>
					<?php echo $assessment->date; ?><br>
					<?php echo $assessment->site->name; ?><br>
					<?php echo $assessment->site->city; ?><br>
					<?php 
						echo $assessment->site->county;
						if ($assessment->site->county !== '' && $assessment->site->state !== '')
							echo ', ';
						echo $assessment->site->state; 
						if (($assessment->site->state !== '' && $assessment->site->country !== '') || ($assessment->site->county !== '' && $assessment->site->country !== ''))
							echo ', '; 
						echo $assessment->site->country; 
					?><br>					
				</div>	
				<div class="span6">
					<h4>&#187; FQA Database:</h4>
					Region: Chicago<br>
					Year Published: 1994<br>
					Description: Swink and Wilhelm
				</div>		
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Details:</h4>			
					Practitioner: <?php echo $assessment->practitioner; ?><br>
 					Latitude: <?php echo $assessment->latitude; ?><br>
 					Longitude: <?php echo $assessment->longitude; ?><br>
					Weather Notes: <?php echo $assessment->weather_notes; ?><br>
 					Duration Notes: <?php echo $assessment->duration_notes; ?><br>
 					Community Type Notes: <?php echo $assessment->community_type_notes; ?><br>
 					Other Notes: <?php echo $assessment->other_notes; ?><br>
 				</div>
 			</div>
			<br>
			<div class="row-fluid">
				<div class="span3">
					<h4>&#187; Conservatism-Based Metrics:</h4>
					Total Mean C: <strong>4.5</strong><br>
					Native Mean C: <strong>5.5</strong><br>
					Native Tree Mean C: <strong>5.5</strong><br>
					Native Shrub Mean C: <strong>5.5</strong><br>
					Native Herbaceous Mean C: <strong>5.5</strong><br>
					Total FQI: <strong>30.5</strong><br>
					Native FQI: <strong>45.5</strong><br>
					Adjusted FQI: <strong>45.5</strong><br>
					% C value 0:  <strong>0%</strong><br>
					% C value 1-3:  <strong>0%</strong><br>
					% C value 4-6:  <strong>0%</strong><br>
					% C value 7-10:  <strong>0%</strong><br>
				</div>
				<div class="span3">	
					<h4>&#187; Species Richness and Wetness:</h4>
					Total Species: <strong>44</strong><br>
					Native Species: <strong>37 (84.1%)</strong><br>
					Non-native Species: <strong>7 (15.9%)</strong><br>
					Mean Wetness: <strong>-2</strong><br>
					Native Mean Wetness: <strong>-2</strong><br>
				</div>
				<div class="span3">
					<h4>&#187; Physiognomy Metrics:</h4>
					Tree: <strong>0 (0.0%)   </strong><br>
					Shrub: <strong>1     (2.3%) </strong><br>    
					Vine: <strong>1     (2.3%)  </strong><br>
					Forb: <strong>22    (50.0%)      </strong><br>
					Grass: <strong>6    (13.6%) </strong><br>
					Sedge: <strong>7    (15.9%) </strong><br>
					Rush: <strong>0     (0.0%) </strong><br>
					Fern: <strong>0     (0.0%) </strong><br>
					Other: <strong>0     (0.0%)      </strong><br>  
				</div>
				<div class="span3">
					<h4>&#187; Duration Metrics:</h4>
					Annual: <strong>22 (50.0%)</strong><br>
					Perennial: <strong>22 (50.0%)</strong><br>
					Biennial: <strong>0 (0.0%)</strong><br>
					<br>	
					Native Annual: <strong>22 (50.0%)</strong><br>
					Native Perennial: <strong>22 (50.0%)</strong><br>
					Native Biennial: <strong>0 (0.0%)</strong><br>
				</div>	
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Species:</h4>
<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>Native?</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>   
<?php   
	$html = '';
	if (count($assessment->taxa) == 0) {
		$html = $html . '<tr><td colspan=9>There are no species in this inventory.</td></tr>';
	} else {
		$sorted_taxa = sort_array_of_objects($assessment->taxa, 'scientific_name');
		foreach ($sorted_taxa as $taxon) {
			$html = $html . '<tr><td>' . $taxon->scientific_name . '</td>';
			$html = $html . '<td>' . $taxon->family . '</td>';
			$html = $html . '<td>' . $taxon->acronym . '</td>';
			$html = $html . '<td>' . $taxon->native . '</td>';
			$html = $html . '<td>' . $taxon->c_o_c . '</td>';
			$html = $html . '<td>' . $taxon->c_o_w . '</td>';
			$html = $html . '<td>' . $taxon->physiognomy . '</td>';
			$html = $html . '<td>' . $taxon->duration . '</td>';
			$html = $html . '<td>' . $taxon->common_name . '</td></tr>';
		}
	}
	echo $html . '</table>';
	
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
				</div>
			</div>
		</div>
    </div> 
    <br><br>
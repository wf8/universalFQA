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
					<strong><?php echo $assessment->date; ?><br>
					<?php echo $assessment->site->name; ?></strong><br>
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
					<?php if ($assessment->custom_fqa) { ?>
						<h4>&#187; Custom FQA Database:</h4>
						Name: <strong><?php echo $assessment->fqa->customized_name; ?></strong><br>
						Description: <br><?php echo $assessment->fqa->customized_description; ?><br>
						<h4>&#187; Original FQA Database:</h4>
						Region: <strong><?php echo $assessment->fqa->region_name; ?></strong><br>
						Year Published: <strong><?php echo $assessment->fqa->publication_year; ?></strong><br>
						Description: <br><?php echo $assessment->fqa->description; ?>
					<?php } else { ?>
						<h4>&#187; FQA Database:</h4>
						Region: <strong><?php echo $assessment->fqa->region_name; ?></strong><br>
						Year Published: <strong><?php echo $assessment->fqa->publication_year; ?></strong><br>
						Description: <br><?php echo $assessment->fqa->description; ?>
					<?php } ?>
				</div>		
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Details:</h4>			
					Practitioner: <strong><?php echo $assessment->practitioner; ?></strong><br>
 					Latitude: <?php echo $assessment->latitude; ?><br>
 					Longitude: <?php echo $assessment->longitude; ?><br>
					Weather Notes: <?php echo $assessment->weather_notes; ?><br>
 					Duration Notes: <?php echo $assessment->duration_notes; ?><br>
 					Community Type Notes: <?php echo $assessment->community_type_notes; ?><br>
 					Other Notes: <?php echo $assessment->other_notes; ?><br>
 					<?php if ($assessment->private == 'private') { ?>
 					This assessment is <strong>private</strong> (viewable only by you).<br>
 					<?php } else { ?>
 					This assessment is <strong>public</strong> (viewable by all users of this website).<br>
 					<?php } ?>
 				</div>
 			</div>
			<br>
			<div class="row-fluid">
				<div class="span3">
					<h4>&#187; Conservatism-Based Metrics:</h4>
					Total Mean C: <strong><?php echo $metrics->total_mean_c; ?></strong><br>
					Native Mean C: <strong><?php echo $metrics->native_mean_c; ?></strong><br>
					Native Tree Mean C: <strong><?php echo $metrics->native_tree_mean_c; ?></strong><br>
					Native Shrub Mean C: <strong><?php echo $metrics->native_shrub_mean_c; ?></strong><br>
					Native Herbaceous Mean C: <strong><?php echo $metrics->native_herbaceous_mean_c; ?></strong><br>
					Total FQI: <strong><?php echo $metrics->total_fqi; ?></strong><br>
					Native FQI: <strong><?php echo $metrics->native_fqi; ?></strong><br>
					Adjusted FQI: <strong><?php echo $metrics->adjusted_fqi; ?></strong><br>
					% C value 0:  <strong><?php echo $metrics->percent_c_0; ?>%</strong><br>
					% C value 1-3:  <strong><?php echo $metrics->percent_c_1_3; ?>%</strong><br>
					% C value 4-6:  <strong><?php echo $metrics->percent_c_4_6; ?>%</strong><br>
					% C value 7-10:  <strong><?php echo $metrics->percent_c_7_10; ?>%</strong><br>
				</div>
				<div class="span3">	
					<h4>&#187; Species Richness and Wetness:</h4>
					Total Species: <strong><?php echo $metrics->total_species; ?></strong><br>
					Native Species: <strong><?php echo $metrics->native_species; ?> (<?php echo $metrics->percent_native_species; ?>%)</strong><br>
					Non-native Species: <strong><?php echo $metrics->non_native_species; ?> (<?php echo $metrics->percent_non_native_species; ?>%)</strong><br>
					Mean Wetness: <strong><?php echo $metrics->mean_wetness; ?></strong><br>
					Native Mean Wetness: <strong><?php echo $metrics->native_mean_wetness; ?></strong><br>
				</div>
				<div class="span3">
					<h4>&#187; Physiognomy Metrics:</h4>
					Tree: <strong><?php echo $metrics->tree; ?> <?php echo $metrics->percent_tree; ?>   </strong><br>
					Shrub: <strong><?php echo $metrics->shrub; ?>     <?php echo $metrics->percent_shrub; ?> </strong><br>    
					Vine: <strong><?php echo $metrics->vine; ?>     <?php echo $metrics->percent_vine; ?>  </strong><br>
					Forb: <strong><?php echo $metrics->forb; ?>    <?php echo $metrics->percent_forb; ?>      </strong><br>
					Grass: <strong><?php echo $metrics->grass; ?>    <?php echo $metrics->percent_grass; ?> </strong><br>
					Sedge: <strong><?php echo $metrics->sedge; ?>    <?php echo $metrics->percent_sedge; ?> </strong><br>
					Rush: <strong><?php echo $metrics->rush; ?>     <?php echo $metrics->percent_rush; ?> </strong><br>
					Fern: <strong><?php echo $metrics->fern; ?>     <?php echo $metrics->percent_fern; ?> </strong><br>
					Bryophyte: <strong><?php echo $metrics->bryophyte; ?>     <?php echo $metrics->percent_bryophyte; ?>      </strong><br>  
				</div>
				<div class="span3">
					<h4>&#187; Duration Metrics:</h4>
					Annual: <strong><?php echo $metrics->annual; ?> <?php echo $metrics->percent_annual; ?></strong><br>
					Perennial: <strong><?php echo $metrics->perennial; ?> <?php echo $metrics->percent_perennial; ?></strong><br>
					Biennial: <strong><?php echo $metrics->biennial; ?> <?php echo $metrics->percent_biennial; ?></strong><br>
					<br>	
					Native Annual: <strong><?php echo $metrics->native_annual; ?> <?php echo $metrics->percent_native_annual; ?></strong><br>
					Native Perennial: <strong><?php echo $metrics->native_perennial; ?> <?php echo $metrics->percent_native_annual; ?></strong><br>
					Native Biennial: <strong><?php echo $metrics->native_biennial; ?> <?php echo $metrics->percent_native_annual; ?></strong><br>
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